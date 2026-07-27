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
            <h2 class="h5 fw-bold mb-4">Join Twitter today.</h2>

            <?php if (isset($_SESSION['errors_signup'])): ?>
                <div class="mb-3">
                    <?php foreach ($_SESSION['errors_signup'] as $error): ?>
                        <div class="alert alert-danger p-2 text-center mb-2"><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors_signup']); ?>
            <?php elseif (isset($_GET["signup"]) && $_GET["signup"] === "success"): ?>
                <div class="alert alert-success text-center mb-3">Signup successful! Please login.</div>
            <?php endif; ?>

            <form action="<?php echo $_SESSION['BURL'] . 'signup/signup'; ?>" method="POST" class="d-flex flex-column gap-3 mb-4">
                
                <div>
                    <input type="text" name="name" class="form-control form-control-lg bg-light border-light rounded-pill" placeholder="Name" 
                           value="<?php echo isset($_SESSION['signupData']['name']) ? htmlspecialchars($_SESSION['signupData']['name']) : ''; ?>" required>
                </div>

                <div>
                    <input type="text" name="username" class="form-control form-control-lg bg-light border-light rounded-pill" placeholder="Username" 
                           value="<?php echo (isset($_SESSION['signupData']['username']) && !isset($_SESSION['errors_signup']['username_taken'])) ? htmlspecialchars($_SESSION['signupData']['username']) : ''; ?>" required>
                </div>

                <div>
                    <input type="email" name="email" class="form-control form-control-lg bg-light border-light rounded-pill" placeholder="Email" 
                           value="<?php echo (isset($_SESSION['signupData']['email']) && !isset($_SESSION['errors_signup']['email_used']) && !isset($_SESSION['errors_signup']['invalid_email'])) ? htmlspecialchars($_SESSION['signupData']['email']) : ''; ?>" required>
                </div>

                <div>
                    <input type="password" name="pwd" class="form-control form-control-lg bg-light border-light rounded-pill" placeholder="Password" required>
                </div>

                <div class="d-flex align-items-center gap-3 mt-2">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold w-100">Sign up</button>
                </div>

            </form>

            <div class="text-secondary small">
                Already have an account? <a href="<?php echo $_SESSION['BURL'] . 'login'; ?>" class="text-decoration-none fw-semibold">Log in</a>
            </div>

        </div>
    </div>

</div>

<?php 
unset($_SESSION['signupData']); 
?>