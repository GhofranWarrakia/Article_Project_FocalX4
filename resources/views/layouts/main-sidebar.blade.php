<!DOCTYPE html>
<html lang="ar">
<head>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .app-sidebar {
            width: 250px;
            background-color: white; /* تغيير اللون إلى الأبيض */
            color: black; /* تغيير لون النص إلى الأسود */
            position: fixed;
            height: 100%;
            overflow-y: auto;
            border-right: 1px solid #e0e0e0; /* إضافة خط فاصل */
        }
        .main-sidebar-header {
            padding: 20px;
            text-align: center;
        }
        .main-sidemenu {
            padding: 20px;
        }
        .app-sidebar__user {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa; /* تغيير اللون إلى لون فاتح */
            border-radius: 10px;
        }
        .avatar {
            border-radius: 50%;
            margin-right: 10px;
        }
        .user-info {
            display: inline-block;
        }
        .side-menu {
            list-style-type: none;
            padding: 0;
        }
        .side-item {
            margin-bottom: 20px;
        }
        .side-item-category {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
            color: #333; /* تغيير لون النص إلى لون داكن */
        }
        .slide {
            cursor: pointer;
        }
        .side-menu__item {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #333; /* تغيير لون النص إلى لون داكن */
            transition: background-color 0.3s;
        }
        .side-menu__item:hover {
            background-color: #f1f1f1; /* تغيير لون الخلفية عند التمرير */
        }
        .side-menu__icon {
            margin-right: 10px;
        }
        .slide-menu {
            display: none;
            list-style-type: none;
            padding-left: 20px;
        }
        .slide-item {
            padding: 10px;
            text-decoration: none;
            color: #333; /* تغيير لون النص إلى لون داكن */
            display: block;
            transition: background-color 0.3s;
        }
        .slide-item:hover {
            background-color: #f1f1f1; /* تغيير لون الخلفية عند التمرير */
        }
        .angle {
            margin-left: auto;
            transition: transform 0.3s;
        }
        .slide.open .angle {
            transform: rotate(90deg);
        }
        .slide.open .slide-menu {
            display: block;
        }
    </style>
</head>
<body>
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}">
                <img src="{{ URL::asset('assets/img/brand/Screenshot (1074).png') }}" class="main-logo" alt="logo">
            </a>
        </div>

        <div class="main-sidemenu">
            <div class="app-sidebar__user clearfix">
                <div class="dropdown user-pro-body">
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{ URL::asset('assets/img/faces/6.jpg') }}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                    <div class="user-info">
                        @if(Auth::check())
                            <h4>{{ Auth::user()->name }}</h4>
                            <span>{{ Auth::user()->email }}</span>
                        @endif
                    </div>
                </div>
            </div>
                <ul class="side-menu">
					<li class="side-item side-item-category"> الحسابات </li>
					
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                    </svg>
                    <span class="side-menu__label">إدارة الحساب</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
				<li><a class="slide-item" href="{{ url('/' . $page='register') }}">إضافة حساب</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='login') }}">تسجيل الدخول</a></li>
                    
                </ul>
            </li>
				<ul class="side-menu">
					<li class="side-item side-item-category">الخيارات الرئيسية</li>
				
					
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                    </svg>
                    <span class="side-menu__label">الخيارات</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
				<li><a class="slide-item" href="{{ url('/' . $page='home') }}">الصفحة الرئيسة </a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='article') }}">قائمة المقالات</a></li>
                    <li><a class="slide-item" href="{{ url('/' . $page='writers') }}">قائمة الكتّاب</a></li>
                </ul>
            </li>

					{{-- @can('برنامج') --}}
					<li class="side-item side-item-category">برنامج الادارة</li>
					
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">ادارة الموقع</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='users') }}">ادارة المستخدمين</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='users') }}">ادارة الكتّاب</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='article') }}">ادارة المقالات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='categories') }}">تصنيفات المقالات</a></li>
			
						</ul>
					</li>

					{{-- @endcan --}}
					<li class="side-item side-item-category">طلبات الترقية</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">إدارة الطلبات  </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='cards') }}">مراجعة طلبات الترقية</a></li>
						</ul>
					
					</li>
					<li class="side-item side-item-category">تقديم طلب ترقية</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/></svg><span class="side-menu__label">ترقية إلى كاتب محتوى</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='mail') }}">فورم تقديم الطلبات</a></li>
						</ul>
					</li>
					
					</li>
					{{-- <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z" opacity=".3"/><path d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z"/></svg><span class="side-menu__label">Tables</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='table-basic') }}">Basic Tables</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='table-data') }}">Data Tables</a></li>
						</ul>
					</li> --}}
					{{-- <li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='widgets') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg><span class="side-menu__label">Widgets</span><span class="badge badge-warning side-badge">Hot</span></a>
					</li> --}}
					{{-- <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity=".3"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg><span class="side-menu__label">Maps</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='map-leaflet') }}">Mapel Maps</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='map-vector') }}">Vector Maps</a></li>
						</ul>
					</li> --}}
					<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        .sub-menu {
            display: none;
            list-style-type: none;
            padding-left: 20px;
        }
        .slide-item:hover + .sub-menu,
        .sub-menu:hover {
            display: block;
        }
        .side-menu__item {
            cursor: pointer;
        }
        
    </style>
    
</head>
<body>
<ul class="side-menu">
        <li class="side-item side-item-category">الاعدادات</li>
        <li class="slide">
            <div class="side-menu__item" data-toggle="slide">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24">
                    <g><rect fill="none"/></g>
                    <g>
                        <g/>
                        <g>
                            <path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65
                                c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5
                                c1.35-0.85,3.8-1.5,5.5-1.5c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6
                                C22.4,5.55,21.75,5.25,21,5z M3,18.5V7c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18
                                C5.3,18,4.1,18.15,3,18.5z M21,18.5c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99
                                c1.2,0,2.4,0.15,3.5,0.5V18.5z"/>
                            <path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18
                                c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3"/>
                        </g>
                        <g>
                            <path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57
                                C14.99,10.69,16.18,10.5,17.5,10.5z"/>
                            <path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57
                                C14.99,13.36,16.18,13.16,17.5,13.16z"/>
                            <path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57
                                C14.99,16.02,16.18,15.83,17.5,15.83z"/>
                        </g>
                    </g>
                </svg>
                <span class="side-menu__label">الاعدادات</span><i class="angle fe fe-chevron-down"></i>
            </div>
            <ul class="slide-menu">
                <li>
                    <a class="slide-item" href="{{ url('/' . $page='roles') }}" onclick="toggleSubMenu(event)">صلاحيات المستخدمين</a>
                    
                <li><a class="slide-item" href="{{ url('/' . $page='block') }}">الحظر</a></li>
            </ul>
        </li>
    </ul>

	

    <script>
        function toggleSubMenu(event) {
            var subMenu = event.target.nextElementSibling;
            if (subMenu.style.display === "block") {
                subMenu.style.display = "none";
            } else {
                subMenu.style.display = "block";
            }
        }
    </script>
    <script>
        document.querySelectorAll('.side-menu__item[data-toggle="slide"]').forEach(item => {
            item.addEventListener('click', () => {
                const parent = item.closest('.slide');
                parent.classList.toggle('open');
            });
        });
    </script>

</body>
</html>
						</ul>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
