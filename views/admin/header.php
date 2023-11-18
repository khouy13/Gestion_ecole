<div class="navigation-admin">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                    <i class="bi bi-person-fill"></i>
                </span>
                <span class="title"><?= $_SESSION['user_info']['fullname'] ?></span>
            </a>
        </li>

        <li>
            <a href="home">
                <span class="icon">
                    <i class="bi bi-house-door"></i>
                </span>
                <span class="title">Acceuil</span>
            </a>
        </li>

        <li>
            <a href="news">
                <span class="icon">
                    <i class="fa-regular fa-file"></i>
                </span>
                <span class="title">Nouveautés</span>
            </a>
        </li>
        <li>
            <a href="users">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="title">Utilisateurs</span>
            </a>
        </li>


        <li>
            <a href="departements">
                <span class="icon">
                    <i class="bi bi-building"></i>
                </span>
                <span class="title">Départements & Fillières</span>
            </a>
        </li>

        <li>
            <a href="classes">
                <span class="icon">
                    <i class="bi bi-easel2"></i>
                </span>
                <span class="title">Classes</span>
            </a>
        </li>

        <li>
            <a href="modules">
                <span class="icon">
                    <i class="bi bi-grid-3x3-gap"></i>
                </span>
                <span class="title">Modules</span>
            </a>
        </li>

        <li>
            <a href="notes">
                <span class="icon">
                    <i class="bi bi-card-checklist"></i>
                </span>
                <span class="title">Espace des notes</span>
            </a>
        </li>

        <li>
            <a href="absences">
                <span class="icon">
                    <i class="bi bi-person-lines-fill"></i>
                </span>
                <span class="title">Absences</span>
            </a>
        </li>
        <li>
            <a href="services">
                <span class="icon">
                    <i class="bi bi-file-earmark"></i>
                </span>
                <span class="title">Services</span>
            </a>
        </li>

        <li>
            <a type="button" class="text-white pass" data-bs-toggle="modal" data-bs-target="#password">
                <span class="icon">
                    <i class="bi bi-lock"></i>
                </span>
                <span class="title">Mot de Passe</span>
            </a>
        </li>


        <li>
            <form class="deconn" method="post">
                <span class="icon ">
                    <i class="bi bi-box-arrow-right "></i>
                </span>
                <span class="title w-100">
                    <button type="submit" name="logout" class="border-0 m-0 text-white w-100 " style="background-color:inherit;text-align:left" title="deconexion">Deconnexion</button>
                </span>
            </form>
        </li>
    </ul>
</div>
<style>
    .pass:hover {
        color: black !important;
    }

    .deconn:hover {
        color: black !important;
    }

    .deconn button:hover {
        color: black !important;
    }
</style>