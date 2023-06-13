<?php
/*
    $data = $menuel['elements']
*/
if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="sidebar-nav-dropdown">';
            echo '<a class="sidebar-nav-dropdown-toggle fs-4" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' nav-icon"></i>';
            }
            echo $data['name'] . '</a>';
            echo '<ul class="sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="nav-item zoom">';
                    echo '<a class="link fs-6" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>
<!--##################################################################################-->
<nav class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px;" id="navbarToggleExternalContent">
    
    <ul class="nav nav-pills flex-column mb-auto">
        @if(isset($appMenus['unz']))
            @foreach($appMenus['unz'] as $menuel)
                @if($menuel['slug'] === 'link')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} nav-icon"></i>
                            @endif
                        @endif
                        {{ $menuel['name'] }}
                        </a>
                    </li>
                @elseif($menuel['slug'] === 'dropdown')
                    <?php renderDropdown($menuel) ?>
                @elseif($menuel['slug'] === 'title')
                    <li class="nav-title">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} nav-icon"></i>
                            @endif
                        @endif
                        {{ $menuel['name'] }}
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</nav>
