<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    public function getMenuCategory($menuCategoryID = false)
    {
        if ($menuCategoryID) {
            return $this->db->table('user_menu_category')->where(['id' => $menuCategoryID['id']])->get()->getRowArray();
        }
        return $this->db->table('user_menu_category')->get()->getResultArray();
    }
    public function getMenu($menuID = false)
    {
        if ($menuID) {
            return $this->db->table('user_menu')
                ->select('*,user_menu_category.menu_category AS category,user_menu.menu_category AS menu_category_id,user_menu.id AS menu_id')
                ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
                ->where(['id' => $menuID['menu_id']])
                ->get()->getRowArray();
        }
        return $this->db->table('user_menu')
            ->select('*,user_menu_category.menu_category AS category,user_menu.menu_category AS menu_category_id,user_menu.id AS menu_id')
            ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
            ->get()->getResultArray();
    }

    public function getSubmenu()
    {
        return $this->db->table('user_submenu')->select('*, user_menu.title AS menu_title, user_submenu.menu AS menu_id, user_submenu.id AS submenu_id, user_submenu.title AS submenu_title, user_submenu.url AS submenu_url')
            ->join('user_menu', 'user_submenu.menu = user_menu.id')
            ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
            ->get()->getResultArray();
    }

    public function createMenuCategory($dataMenuCategory)
    {
        $this->db->transBegin();
        $this->db->table('user_menu_category')->insert(['menu_category' => $dataMenuCategory['inputMenuCategory']]);
        $menuCategoryID = $this->db->insertID();
        $this->db->table('user_access')->insert(['role_id' => 1, 'menu_category_id' => $menuCategoryID]);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function updateMenuCategory($menuCategoryID)
    {
        return $this->db->table('user_menu_category')->update(['menu_category' => $menuCategoryID['inputMenuCategory']]);
    }

    public function createMenu($dataMenu)
    {
        $this->db->transBegin();
        $this->db->table('user_menu')->insert([
            'menu_category' => $dataMenu['inputMenuCategory2'],
            'title'         => $dataMenu['inputMenuTitle'],
            'url'           => $dataMenu['inputMenuURL'],
            'icon'          => $dataMenu['inputMenuIcon'],
            'parent'        => 0
        ]);
        $menuID = $this->db->insertID();
        $this->db->table('user_access')->insert(['role_id' => 1, 'menu_id' => $menuID]);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function createSubMenu($dataSubmenu)
    {
        $this->db->transBegin();
        $this->db->table('user_submenu')->insert([
            'menu'            => $dataSubmenu['inputMenu'],
            'title'           => $dataSubmenu['inputSubmenuTitle'],
            'url'             => $dataSubmenu['inputSubmenuURL']
        ]);
        $submenuID = $this->db->insertID();
        $this->db->table('user_access')->insert(['role_id' => 1, 'submenu_id' => $submenuID]);
        $this->db->table('user_menu')->update(['parent' => 1], ['id' => $dataSubmenu['inputMenu']]);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function getMenuByUrl($menuUrl)
    {
        return $this->db->table('user_menu')->where(['url' => $menuUrl])->get()->getRowArray();
    }

    public function getUser($username = false, $userID = false)
    {
        if ($username) {
            return $this->db->table('users')
                ->select('*,users.id AS userID,user_role.id AS role_id')
                ->join('user_role', 'users.role = user_role.id')
                ->where(['username' => $username])
                ->get()->getRowArray();
        } elseif ($userID) {
            return $this->db->table('users')
                ->select('*,users.id AS userID,user_role.id AS role_id')
                ->join('user_role', 'users.role = user_role.id')
                ->where(['users.id' => $userID])
                ->get()->getRowArray();
        } else {
            return $this->db->table('users')
                ->select('*,users.id AS userID,user_role.id AS role_id')
                ->join('user_role', 'users.role = user_role.id')
                ->get()->getResultArray();
        }
    }

    public function getAccessMenuCategory($role)
    {
        return $this->db->table('user_menu_category')
            ->select('*,user_menu_category.id AS menuCategoryID')
            ->join('user_access', 'user_menu_category.id = user_access.menu_category_id')
            ->where(['user_access.role_id' => $role])
            ->get()->getResultArray();
    }

    /**
     * Retrieves user access menu based on the role.
     *
     * @param int $role The ID of the user role.
     * @return array The access menu for the specified role.
     */
    public function getAccessMenu($role)
    {
        return $this->db->table('user_menu')
            ->join('user_access', 'user_menu.id = user_access.menu_id')
            ->where(['user_access.role_id' => $role])
            ->get()->getResultArray();
    }

    /**
     * Retrieves user roles.
     *
     * @param int|bool $role The ID of the role to retrieve, or false to retrieve all roles.
     * @return array The user role(s).
     */
    public function getUserRole($role = false)
    {
        if ($role) {
            return $this->db->table('user_role')->where(['id' => $role])->get()->getRowArray();
        }
        return $this->db->table('user_role')->get()->getResultArray();
    }

    /**
     * Creates a new user.
     *
     * @param array $dataUser Contains 'inputFullname', 'inputUsername', 'inputPassword', and 'inputRole'.
     * @return bool True on success, false on failure.
     */
    public function createUser($dataUser)
    {
        return $this->db->table('users')->insert([
            'fullname'    => $dataUser['inputFullname'],
            'username'    => $dataUser['inputUsername'],
            'password'    => password_hash($dataUser['inputPassword'], PASSWORD_DEFAULT),
            'role'        => $dataUser['inputRole'],
            'created_at'  => date('Y-m-d h:i:s')
        ]);
    }

    /**
     * Updates an existing user.
     *
     * @param array $dataUser Contains 'userID', 'inputFullname', 'inputUsername', 'inputPassword', and 'inputRole'.
     * @return bool True on success, false on failure.
     */
    public function updateUser($dataUser)
    {
        if ($dataUser['inputPassword']) {
            $password = password_hash($dataUser['inputPassword'], PASSWORD_DEFAULT);
        } else {
            $user         = $this->getUser(userID: $dataUser['userID']);
            $password     = $user['password'];
        }
        return $this->db->table('users')->update([
            'fullname'        => $dataUser['inputFullname'],
            'username'         => $dataUser['inputUsername'],
            'password'         => $password,
            'role'             => $dataUser['inputRole'],
        ], ['id' => $dataUser['userID']]);
    }

    /**
     * Deletes a user by their ID.
     *
     * @param int $userID The ID of the user to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteUser($userID)
    {
        return $this->db->table('users')->delete(['id' => $userID]);
    }

    /**
     * Creates a new user role.
     *
     * @param array $dataRole Contains 'inputRoleName'.
     * @return bool True on success, false on failure.
     */
    public function createRole($dataRole)
    {
        return $this->db->table('user_role')->insert(['role_name' => $dataRole['inputRoleName']]);
    }

    /**
     * Updates an existing user role.
     *
     * @param array $dataRole Contains 'roleID' and 'inputRoleName'.
     * @return bool True on success, false on failure.
     */
    public function updateRole($dataRole)
    {
        return $this->db->table('user_role')->update(['role_name' => $dataRole['inputRoleName']], ['id' => $dataRole['roleID']]);
    }

    /**
     * Deletes a user role.
     *
     * @param int $role The ID of the role to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteRole($role)
    {
        return $this->db->table('user_role')->delete(['id' => $role]);
    }

    /**
     * Checks if a user has access to a specific menu category.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuCategoryID'.
     * @return int The count of access records.
     */
    public function checkUserMenuCategoryAccess($dataAccess)
    {
        return  $this->db->table('user_access')
            ->where([
                'role_id' => $dataAccess['roleID'],
                'menu_category_id' => $dataAccess['menuCategoryID']
            ])
            ->countAllResults();
    }

    /**
     * Checks if a user has access to a specific menu.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuID'.
     * @return int The count of access records.
     */
    public function checkUserAccess($dataAccess)
    {
        return  $this->db->table('user_access')->where([
            'role_id' => $dataAccess['roleID'],
            'menu_id' => $dataAccess['menuID']
        ])->countAllResults();
    }

    /**
     * Checks if a user has access to a specific submenu.
     *
     * @param array $dataAccess Contains 'roleID' and 'submenuID'.
     * @return int The count of access records.
     */
    public function checkUserSubmenuAccess($dataAccess)
    {
        return  $this->db->table('user_access')->where([
            'role_id'       => $dataAccess['roleID'],
            'submenu_id'    => $dataAccess['submenuID']
        ])->countAllResults();
    }

    /**
     * Inserts a new menu category permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuCategoryID'.
     * @return bool True on success, false on failure.
     */
    public function insertMenuCategoryPermission($dataAccess)
    {
        return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'menu_category_id' => $dataAccess['menuCategoryID']]);
    }

    /**
     * Deletes a menu category permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuCategoryID'.
     * @return bool True on success, false on failure.
     */
    public function deleteMenuCategoryPermission($dataAccess)
    {
        return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'menu_category_id' => $dataAccess['menuCategoryID']]);
    }

    /**
     * Inserts a new menu permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuID'.
     * @return bool True on success, false on failure.
     */
    public function insertMenuPermission($dataAccess)
    {
        return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'menu_id' => $dataAccess['menuID']]);
    }

    /**
     * Deletes a menu permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'menuID'.
     * @return bool True on success, false on failure.
     */
    public function deleteMenuPermission($dataAccess)
    {
        return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'menu_id' => $dataAccess['menuID']]);
    }

    /**
     * Inserts a new submenu permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'submenuID'.
     * @return bool True on success, false on failure.
     */
    public function insertSubmenuPermission($dataAccess)
    {
        return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'submenu_id' => $dataAccess['submenuID']]);
    }

    /**
     * Deletes a submenu permission for a user role.
     *
     * @param array $dataAccess Contains 'roleID' and 'submenuID'.
     * @return bool True on success, false on failure.
     */
    public function deleteSubmenuPermission($dataAccess)
    {
        return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'submenu_id' => $dataAccess['submenuID']]);
    }
}
