<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.layouts.common-head')
</head>

<body>
    <main class="frame">	
    @include('dashboard.layouts.sidebar')
    {{-- libraries included codes --}}
    <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;"></div>
        {{-- <a href="https://web.whatsapp.com/send?phone=+971524952170&text=Hello%20Customer%20Support" class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a> --}}

    {{-- ----- end ----- --}}
        
    <div class="content_cont">
        <div class="navbar_Section">
            @include('dashboard.layouts.header')
        </div>
        <div class="main_content">
            @section('main-content');
            @show
            @include('dashboard.layouts.footer')
        </div>
    </div>
        @stack('custom-scripts')
    
    </main>
</body>
</html>