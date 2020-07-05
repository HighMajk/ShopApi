<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">E-AlCo</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/index.php">Główna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/store.php">Sklep</a>
            </li>
            <?php
            if(Me::IsLoggedIn()) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user/settings.php">Konto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart.php">Koszyk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/api/auth/logout.php">Wyloguj</a>
                </li>
                <?php
            }
            else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login.php">Zaloguj</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/register.php">Zarejestruj</a>
                </li>
                <?php
            }

            ?>

        </ul>
    </div>
</nav>