### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/staff-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/staff-pages/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/staff-pages/src/resources/views/livewire/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/staff-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/staff-pages/src/resources/views/web/**/*.blade.php",
    "./vendor/4geo35/staff-pages/src/resources/views/livewire/web/**/*.blade.php"

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"

#### Views

Сокращение для представлений: `sp`  
Меню для панели администрирования: `<x-sp::menu-item/>`

#### Livewire Components

Web

- `sp-web-employee-index`
- `sp-web-employee-form`

#### Config

Название файла: `staff-pages`

- `employeePrefix` => `employees`
- `employeePageTitle` => `Сотрудники`
- `departmentPrefix` => `departments`
- `departmentPageTitle` => `Отделы`
- `useBreadcrumbs` => `true`
- `useH1` => `true`
- `departmentAsPages` => `false`
- `departmentPageH1Prefix` => ``: Например "Специальность", получится "Специальность $title"
- `useEnableBtn` => `true`: Отключает кнопку в тизере, убирает галочку в аминке и убирает форму с общей страницы, но сама форма в админке останется
- `useAvailableForms` => `true`: Вырубает все формы, тогда из админки пропадет ссылка на форму, уйдет форма со старницы и скроется кнопка, но галочка в админке останется
- `fullCol` => `false`: Тизер на всю ширину
- `galleryButton` => `3`: Если поставить число, то будет показываться только если изображений больше этого числа
- `queryDepartmentKey` => `department`
- `galleryBtnTitle` => `env("EMPLOYEE_GALLERY_BTN_TITLE", "Документы проверены")`
- `modalBtnTitle` => `env("EMPLOYEE_MODAL_BTN_TITLE", "Записаться на прием")`
- `anchorBtnTitle` => `env("EMPLOYEE_ANCHOR_BTN_TITLE", "Записаться на прием")`
- `modalTitle` => `env("EMPLOYEE_REQUEST_MODAL_TITLE", "Записаться на прием")`
- `modalSubTitle` => `env("EMPLOYEE_REQUEST_MODAL_SUB_TITLE", "Перезвоним на указанный номер, чтобы подтвердить запись.")`
- `modalEmployeeFieldTitle` => `env("EMPLOYEE_REQUEST_MODAL_FIELD_TITLE", "Специалист")`
- `employeeShort` => `Специализация`
- `employeeDescription` => `Описание`
- `employeeComment` => `График работы`
- `employeeEnableBtn` => `Включить запись на прием`

#### Routes

Файл `admin.php`, `middleware(["web", "auth", "app-management"])`, `prefix(config("staff-pages.departmentPrefix"))`, `prefix2(config("staff-pages.employeePrefix"))`

- `admin.departments.index` => `admin/{prefix}`
- `admin.departments.show` => `admin/{prefix}/{department}`
- `admin.employees.index` => `admin/{prefix2}`
- `admin.employees.show` => `admin/{prefix2}/{department}`

Файл `web.php`, `middleware(["web"])`, `prefix(config("staff-pages.employeePrefix"))`, `prefix2(config("staff-pages.departmentPrefix"))`

- `web.employees.index` => `{prefix}`
- `web.employees.department` => `{prefix}/{prefix2}/{department}`: if config("staff-pages.departmentAsPages")
