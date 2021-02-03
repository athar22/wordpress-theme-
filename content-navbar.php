<!-- Main Nav BEGIN -->
<header id="header-main">
    <!-- Main navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <a class="navbar-brand" href="<?php echo get_home_url();?>">
                <img
                    src="<?php bloginfo('template_directory') ;?>/assets/images/eba-logo.png"
                    width="230"
                    height="auto"
                    alt="EBA Members Directory"
                    title="EBA Members Directory"
                    loading="lazy"
                    />
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                            class="nav-link "
                            href="<?php echo get_home_url();?>"
                           
                           
                            >
                            Home
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a
                            class="nav-link"
                            href="<?php echo get_page_link(139)?>"
                            id="navbarDropdown"
                            role="button"
                           
                            aria-haspopup="true"
                            aria-expanded="false"
                            >
                            To Advertise
                        </a>

                    </li>
					<li class="nav-item ">
						
                       <button
                type="button"
                class=" btn  nav-link "
                data-toggle="modal"
                data-target="#exampleModal"
                >
                 Advanced Search
            </button>
            
                    </li>
                    <li class="nav-item ">
                        <a
                            style="color: #ffffff"
                            class="btn btn-primary  nav-link"
                            href="<?php echo wp_logout_url(home_url()); ?>"

                            >
                            Logout
                        </a>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Main Nav END -->