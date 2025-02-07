        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Schnoogs' homeplate</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
 <!--                       <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="#signup">Contact</a></li>
-->
                        {if $CFG.session.loggedin}

                            <li class="nav-item"><a class="nav-link" href="hosts.php">Hosts</a></li>
                                <li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>
                                <li class="nav-item"><a class="nav-link" href="icons.php">Projects</a></li>
                                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        {else}
                                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        {/if}

                    </ul>

                </div>
            </div>
        </nav>
