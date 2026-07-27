<?php require_once(__DIR__ . '/inc/head.php'); ?>

<div class="row g-0 vh-100">

    <div class="col-lg-6 bg-primary text-white d-flex align-items-center justify-content-center p-5">
        <div class="d-flex flex-column gap-4">

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-search fs-2"></i>
                <span class="fw-bold fs-5">Follow your interests.</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-people fs-2"></i>
                <span class="fw-bold fs-5">Hear what people are talking about.</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-chat-dots fs-2"></i>
                <span class="fw-bold fs-5">Join the conversation.</span>
            </div>

        </div>
    </div>

    <div class="col-lg-6 bg-white d-flex align-items-center justify-content-center p-5">
        <div class="w-100" style="max-width: 420px;">

            <i class="bi bi-twitter text-primary display-4 mb-4 d-block"></i>

            <h1 class="fw-bold display-6 mb-3">See what’s happening in the world right now</h1>
            <h2 class="h5 fw-bold mb-4">Log In Now.</h2>

            <?php if (isset($_SESSION['errors_login'])): ?>
                <div class="mb-3">
                    <?php foreach ($_SESSION['errors_login'] as $error): ?>
                        <div class="alert alert-danger p-2 text-center mb-2"><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors_login']); ?>
            <?php endif; ?>

            <form action="<?php echo $_SESSION['BURL'] . 'login/login'; ?>" method="POST" class="d-flex flex-column gap-3 mb-4">
                
                <div>
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" name="username" class="form-control form-control-lg bg-light border-light" placeholder="Enter your username" required>
                </div>

                <div>
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="pwd" class="form-control form-control-lg bg-light border-light" placeholder="Enter your password" required>
                </div>

                <div class="d-flex align-items-center gap-3 mt-2">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">Log In</button>
                    <span class="text-secondary small">Dont Have an account? <a href="<?php echo $_SESSION['BURL'] . 'signup'; ?>" class="text-decoration-none">Signup</a></span>
                </div>

            </form>

        </div>
    </div>

</div>

