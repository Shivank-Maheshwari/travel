<nav class="navigation-bar">
                        <div class="navigation-bar-content">
                            <div class="element">
                                <a class="dropdown-toggle" href="#">TravelBugs</a>
                                <ul class="dropdown-menu" data-role="dropdown">
                                    <!--<li><a href="#">Home</a></li>-->
									<li><a id="plan">Plan</a></li>
									<li><a id="curplan">Current Plans</a></li>
									<li><a id="searchtravel">Search Co-Travellers</a></li>
									<?php
									
									if($x==7)
									{
                                    echo '<li><a href="admin/home.php">Admin Area</a></li>';
                                    }
									?>
									<li class="divider"></li>
                                   
                                    <li><a href="javascript:closeit();">Exit</a></li>
                                </ul>
                            </div>

                            <span class="element-divider"></span>
                            <a class="element brand" href="<?php echo $_SERVER['REQUEST_URI'] ?>"><span class="icon-spin"></span></a>
                            <a class="element brand" href="javascript:print()"><span class="icon-printer"></span></a>
                            <span class="element-divider"></span>

                            <!--<div class="element input-element">
                                <form>
                                    <div class="input-control text">
                                        <input type="text" placeholder="Search...">
                                        <button class="btn-search"></button>
                                    </div>
                                </form>
                            </div>-->

                            <div class="element place-right">
                                <a class="dropdown-toggle" href="#">
                                    <span class="icon-cog"></span>
                                </a>
                                <ul class="dropdown-menu place-right" data-role="dropdown">
                                    <li><a href="#" id="profile"">Profile</a></li>
                                    <li><a href="logout.php">Log Out</a></li>
                                </ul>
                            </div>
                            <span class="element-divider place-right"></span>
                            <a class="element place-right" href="#" id="update"><span class="icon-locked-2"></span></a>
                            <span class="element-divider place-right"></span>
                            <button class="element image-button image-left place-right">
                                <?php echo $_SESSION['username']?>
                                <img src="images/211858_100001930891748_287895609_q.jpg"/>
                            </button>
                        </div>
                    </nav>
				
    
