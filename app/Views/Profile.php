<?php require_once( __DIR__ . '\inc\head.php') ?>
<?php require_once( __DIR__ . '\inc\header.php') ?>

<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div id="profileHeader"></div>

            <div id="userPosts" class="mt-4"></div>

        </div>
    </div>
</div>

<script> 
    let res = <?php echo json_encode($response); ?>;
    console.log(res);

    if (res && res.data && res.data.user_data) {
        const userData = res.data.user_data;
        
        let followButtonHtml = '';
        if (res.user_info && !res.data.userIsME) {
            if (res.data.doIFollowHem === false) {
                followButtonHtml = `
                    <form action="http://localhost/the_cooler_twitter_clone/follows/followTo/${res.data.user_id}" method="POST">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Follow</button>
                    </form>
                `;
            } else {
                followButtonHtml = `
                    <form action="http://localhost/the_cooler_twitter_clone/follows/unfollowTo/${res.data.user_id}" method="POST">
                        <button type="submit" class="btn btn-outline-danger rounded-pill px-4 fw-bold">Unfollow</button>
                    </form>
                `;
            }
        } else if(res.user_info && res.data.userIsME){
            followButtonHtml = `
                <form action="http://localhost/the_cooler_twitter_clone/Profile/edit">
                    <button type="submit" class="btn btn-light rounded-pill px-3">edit</button>
                </form>
            `;
        }

        let profileCard = `
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3 class="fw-bold mb-0">${userData.name}</h3>
                            <span class="text-muted">@${userData.username}</span>
                        </div>
                        <div class="followButt">
                            ${followButtonHtml}
                        </div>
                    </div>

                    ${userData.about_text ? `<p class="mt-3 mb-2">${userData.about_text}</p>` : ''}

                    <div class="d-flex gap-4 text-muted small my-3">
                        ${userData.email ? `<div><i class="bi bi-envelope"></i> ${userData.email}</div>` : ''}
                        ${userData.birthday ? `<div><i class="bi bi-calendar"></i> Joined / Born: ${userData.birthday}</div>` : ''}
                        ${userData.links ? `<div><i class="bi bi-link-45deg"></i> <a href="${userData.links}" target="_blank" class="text-decoration-none">${userData.links}</a></div>` : ''}
                    </div>

                    <hr class="my-3 text-muted">

                    <div class="d-flex gap-4">
                        <div>
                            <span class="fw-bold text-dark">${res.data.num_who_A_is_following ?? 0}</span>
                            <span class="text-muted"> Following</span>
                        </div>
                        <div>
                            <span class="fw-bold text-dark">${res.data.num_who_follows_A ?? 0}</span>
                            <span class="text-muted"> Followers</span>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.querySelector('#profileHeader').innerHTML = profileCard;

        if (res.data.posts && Array.isArray(res.data.posts)) {
            let postsHtml = '';
            res.data.posts.reverse().forEach(post => {
                postsHtml += `
                    <div class="card mb-3 shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-0">${post.name}</h6>
                            <small class="text-muted">@${post.username}</small>
                            <p class="card-text mt-2">${post.post_text}</p>
                            <small class="text-muted d-block mb-3">${post.created_at}</small>

                            <div class="d-flex gap-3">
                                <a href="http://localhost/the_cooler_twitter_clone/Post/open_post/${post.post_id}" class="text-decoration-none text-secondary">Comments</a>
                                ${res.user_info ? `
                                    <a href="http://localhost/the_cooler_twitter_clone/likes/like/${post.post_id}" class="text-decoration-none">
                                        <button class="btn btn-sm btn-outline-danger">Like ${post.total_likes ?? 0}</button>
                                    </a>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                `;
            });
            document.querySelector('#userPosts').innerHTML = postsHtml;
        }
    }
</script>

<?php require_once(__DIR__ . '/inc/footer.php') ?>