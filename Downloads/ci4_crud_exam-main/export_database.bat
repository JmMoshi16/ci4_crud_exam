@echo off
echo ========================================
echo Database Export Script
echo ========================================
echo.

REM Get database name
set /p dbname="Enter your database name (default: ci4_crud_exam): "
if "%dbname%"=="" set dbname=ci4_crud_exam

REM Get MySQL username
set /p username="Enter MySQL username (default: root): "
if "%username%"=="" set username=root

echo.
echo Exporting database: %dbname%
echo Username: %username%
echo Output file: database_export.sql
echo.

REM Export database
mysqldump -u %username% -p %dbname% > database_export.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ========================================
    echo SUCCESS! Database exported successfully
    echo ========================================
    echo.
    echo File created: database_export.sql
    echo Location: %CD%\database_export.sql
    echo.
) else (
    echo.
    echo ========================================
    echo ERROR! Database export failed
    echo ========================================
    echo.
    echo Please check:
    echo - MySQL is running
    echo - Database name is correct
    echo - Username is correct
    echo - Password is correct
    echo.
)

pause
