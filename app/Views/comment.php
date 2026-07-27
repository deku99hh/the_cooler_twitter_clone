<?php require_once( __DIR__ . '\inc\head.php') ?>
<?php require_once( __DIR__ . '\inc\header.php') ?>


<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div class="postMainBody"></div>

            <div class="commentFormBody"></div>

        </div>
    </div>
</div>



    <script> 
        let res = <?php print_r(json_encode($response)) ?> ;
        console.log(res);

        res.data.posts = res.data.posts.flat().sort((a, b) => new Date(a.created_at) - new Date(b.created_at));


        let post = `
            <div class="card mb-3 shadow-sm border-0 p-2">
                <div class="card-body">
                    <a href="http://localhost/the_cooler_twitter_clone/Profile/openProfile/${res.data.post_data.user_id}" class="text-decoration-none text-dark">
                        <h3 class="card-title fw-bold text-primary mb-1">${res.data.post_data.name}</h3>
                        <h6 class="text-muted mb-3">@${res.data.post_data.username}</h6>
                    </a>
                    <p class="card-text fs-5 mt-2 mb-4">${res.data.post_data.post_text}</p>
                    <small class="text-muted d-block mb-3">
                        <i class="bi bi-calendar"></i> ${res.data.post_data.created_at}
                    </small>

                    <div class="d-flex gap-3">
                            ${res.user_info ? 
                            `
                                <a href="http://localhost/the_cooler_twitter_clone/likes/like/${res.data.post_data.post_id}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-outline-danger">Like</button>
                                </a> 
                                <span class="align-self-center">${res.data.post_data.total_likes}</span>

                                <a href="http://localhost/the_cooler_twitter_clone/stars/star/${res.data.post_data.post_id}" class="text-decoration-none align-self-center">
                                    ${res.data.post_data.is_starred != "0" ? 'stared' : 'not stared'}
                                </a>
                            ` : ''}
                    </div>
                </div>
            </div>
        `
        document.querySelector('.postMainBody').innerHTML = post;


        if (res.user_info) {
            let commentForm = `
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-3">
                        <form action="http://localhost/the_cooler_twitter_clone/comment/makeNewComment/${res.data.post_data.post_id}" method="POST">
                            <div class="input-group">
                                <input type="text" name="comment_text" class="form-control" placeholder="Write a comment..." required>
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="my-4 text-muted">
            `;
            document.querySelector('.commentFormBody').innerHTML = commentForm;
        }


    </script>
</body>
</html>
