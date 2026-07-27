<?php require_once(__DIR__ . '/inc/head.php') ?>
<?php require_once(__DIR__ . '/inc/header.php') ?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Edit Profile</h4>

                    <div id="formContainer"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let res = <?php echo json_encode($response ?? []); ?>;
    console.log("Response Data:", res);

    const userdata = res.data.userdata

    if (userdata && Object.keys(userdata).length > 0) {
        let formHtml = `
            <form action="http://localhost/the_cooler_twitter_clone/Profile/update" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">Name</label>
                    <input type="text" class="form-control rounded-3" name="name" value="${userdata.name || ''}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">About / Bio</label>
                    <textarea class="form-control rounded-3" name="about_text" rows="3" placeholder="Write something about yourself...">${userdata.about_text || ''}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">Website / Links</label>
                    <input type="text" class="form-control rounded-3" name="links" value="${userdata.links || ''}" placeholder="https://example.com">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">Birthday</label>
                    <input type="date" class="form-control rounded-3" name="birthday" value="${userdata.birthday || ''}">
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Save Changes</button>
                </div>

            </form>
        `;

        document.querySelector('#formContainer').innerHTML = formHtml;
    } else {
        document.querySelector('#formContainer').innerHTML = `
            <div class="alert alert-warning">Could not load user data. Please make sure you are logged in.</div>
        `;
    }
</script>

<?php require_once(__DIR__ . '/inc/footer.php') ?>