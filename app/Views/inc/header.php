<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href= <?php echo $_SESSION["BURL"] ?> >MyTwitter</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href= <?php // echo $_SESSION["BURL"] ?> >Home</a>
        </li> -->
        
        <?php if ($response['user_info']) { ?>
          <li class="nav-item"><a class="nav-link" href= <?php echo $_SESSION["BURL"] . "home/following" ?> >Follows</a></li>
          <li class="nav-item"><a class="nav-link" href= <?php echo $_SESSION["BURL"] . "Notifications" ?> >Notifications</a></li>
          <li class="nav-item"><a class="nav-link" href= <?php echo $_SESSION["BURL"] . "profile" ?> >Profile</a></li>
        <?php } else { ?>
          <li class="nav-item"><a class="nav-link" href= <?php echo $_SESSION["BURL"] . "login" ?> >Login</a></li>
          <li class="nav-item"><a class="nav-link" href= <?php echo $_SESSION["BURL"] . "signup" ?> >Signup</a></li>
        <?php } ?>
      </ul>

      <form class="d-flex" action= <?php echo $_SESSION["BURL"] . "search/searchRedirect" ?> method="post">
        <input class="form-control me-2 rounded-pill" type="search" name="keyWords" placeholder="Search..." required>
        <button class="btn btn-outline-primary rounded-pill" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>