<header class="header-wrapper border-bottom border-light">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="text-secondary fw-semibold" style="font-size: 0.8rem; letter-spacing: 0.08em; color: var(--text-secondary);">EDUPANEL <span style="margin: 0 0.4rem; color: var(--border-dark);">/</span> <span style="color: var(--text-primary);"><?= esc(session('user')['role'] ?? 'USER') ?></span></div>
        
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center py-1 px-3" style="background: rgba(255,255,255,0.03); border: 1px solid var(--border-light); border-radius: 20px;">
                <span style="font-size: 0.8rem; font-weight: 500; color: var(--text-primary); margin-right: 0.5rem;"><?= esc(session('user')['fullname'] ?? 'User') ?></span>
                <div style="width: 6px; height: 6px; border-radius: 50%; background-color: #10b981; box-shadow: 0 0 8px rgba(16,185,129,0.8);"></div>
            </div>
            
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--text-secondary); transition: color 0.2s;">
                    <i class="bi bi-gear-fill fs-5"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-md-clean border-clean" aria-labelledby="userDropdown" style="background-color: var(--bg-surface); backdrop-filter: blur(20px); border: 1px solid var(--border-dark); margin-top: 0.5rem; min-width: 200px;">
                    <li><h6 class="dropdown-header text-muted" style="font-size: 0.7rem; letter-spacing: 0.05em; text-transform: uppercase;">Account</h6></li>
                    <li><a class="dropdown-item py-2 text-dark" href="<?= base_url('profile') ?>" style="font-size: 0.85rem; font-weight: 500;"><i class="bi bi-person me-2 text-indigo-600"></i> My Profile</a></li>
                    <li><hr class="dropdown-divider border-light my-1"></li>
                    <li><a class="dropdown-item py-2" href="<?= base_url('logout') ?>" style="font-size: 0.85rem; font-weight: 500; color: #fb7185;"><i class="bi bi-box-arrow-right me-2 text-rose-600"></i> Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
