<nav id="main-nav" class="navbar row navbar-expand-md d-flex flex-row navigation ">
    <div class=" menu col-md-3 col-lg-3 col-sm-3 col-3">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div class=" menuContent row collapse navbar-collapse col-md-9 col-lg-8 col-sm-12 col-12" id="navbarTogglerDemo02">
        <?php
        require_once __DIR__ . '/../config/config.php';
        $sql = "select MenuItemName as nameMenu,MenuItemHref as href,MenuPositionName as position,StatusName as status 
                from menu as m inner join menuposition as mp on m.MenuPositionId = mp.MenuPositionId 
                inner join statuses s on s.StatusId = m.StatusId";
        $menu = $pdo->prepare($sql);
        $menu->execute();
        $item = $menu->fetchAll();
        ?>
        <ul class=" navbar-nav  d-flex  align-items-center justify-content-between col-12">
            <?php
            foreach ($item as $i) {
                if ($i->position == "Header") {
                    if (!($i->nameMenu == "Logovanje")) {
                        echo " <li class='nav-link'><a href=" . $i->href . ">" . $i->nameMenu . "</a></li>";
                    } else {
                        echo "<li class='nav-link'>";
                        require_once __DIR__ . '/../LoginAndRegistration/headerUsername.php';
                        echo "</li>";
                    }
                }
            }
            if (isset($_SESSION['logged_in'])) {
                echo "<li class='nav-link user'>
               <label data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Vise <i class='btn dropdown-toggle'>
                    </i> </label>
                <ul class='dropMenu dropdown-menu dropdown-menu-right'>  ";
                foreach ($item as $i) {
                    if ($_SESSION['StatusUser'] == "Admin" && $i->position == "DropDownMenu" && $i->status == "Admin") {
                        echo "<li><a href='" . $i->href . "''>" . $i->nameMenu . "</a></li>";
                    }
                }
                foreach ($item as $i) {
                    if ($_SESSION['StatusUser'] == "Moderator" && $i->position == "DropDownMenu" && $i->status == "Moderator") {
                        echo "<li><a href='" . $i->href . "''>" . $i->nameMenu . "</a></li>";
                    }
                }
                foreach ($item as $i) {
                    if ($i->position == "DropDownMenu" && $i->status == "Korisnik") {
                        echo "<li><a href='" . $i->href . "''>" . $i->nameMenu . "</a></li>";
                    }
                }
            } ?>
        </ul>
        </li>
        </ul>
    </div>
</nav>