 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ route('admin.index') }}">
                 <i class="mdi mdi-home menu-icon"></i>
                 <span class="menu-title">@lang('panel.dashboard')</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('category.index') }}">
                 <i class="mdi mdi-library-books menu-icon"></i>
                 <span class="menu-title">@lang('category.categories')</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('book.index') }}">
                 <i class="mdi mdi-animation menu-icon"></i>
                 <span class="menu-title">@lang('book.books')</span>
             </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{ route('author.index') }}">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">@lang('author.authors')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('publisher.index') }}">
                <i class="mdi mdi-home-modern menu-icon"></i>
                <span class="menu-title">@lang('publisher.publishers')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reader.index') }}">
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                <span class="menu-title">@lang('reader.readers')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('loan.index') }}">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">@lang('loan.loans')</span>
            </a>
        </li>
     </ul>
 </nav>
 <!-- partial -->