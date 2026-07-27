<?php require_once( __DIR__ . '\inc\head.php') ?>
<?php require_once( __DIR__ . '\inc\header.php') ?>


<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div class="postMainBody"></div>

            <div class="commentsMainBody"></div>

        </div>
    </div>
</div>



    <script> 
        let res = <?php print_r(json_encode($response)) ?> ;
        console.log(res);

        let post = `
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <a href="http://localhost/the_cooler_twitter_clone/Profile/openProfile/${res.data.post_data.user_id}" class="text-decoration-none text-dark">
                        <h6 class="card-title fw-bold mb-0">${res.data.post_data.name}</h6>
                        <small class="text-muted">@${res.data.post_data.username}</small>
                    </a>
                    <p class="card-text mt-2">${res.data.post_data.post_text}</p>
                    <small class="text-muted d-block mb-3">${res.data.post_data.created_at}</small>

                    <div class="d-flex gap-3">
                        
                            ${res.user_info ? 
                            `
                                <a href="http://localhost/the_cooler_twitter_clone/comment/comment/${res.data.post_data.post_id}" class="text-decoration-none text-secondary">Reply</a>

                                <a href="http://localhost/the_cooler_twitter_clone/likes/like/${res.data.post_data.post_id}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-outline-danger">Like</button>
                                </a> 
                                <span>${res.data.post_data.total_likes}</span>

                                <a href="http://localhost/the_cooler_twitter_clone/stars/star/${res.data.post_data.post_id}" class="text-decoration-none">
                                    ${res.data.post_data.is_stared != "0" ? 'stared' : 'not stared'}
                                </a>

                            ` : ''}
                    </div>
                </div>
            </div>
        `
        document.querySelector('.postMainBody').innerHTML = post;


        let comments = "";
        res.data.commentsarr.forEach(comment => {
            comments += `
                <div class="card mb-2 bg-light border-0 shadow-sm ms-4">
                    <div class="card-body py-2">
                        <a href="http://localhost/the_cooler_twitter_clone/Profile/openProfile/${comment.user_id}" class="text-decoration-none text-dark">
                            <h6 class="card-title fw-bold mb-0">${comment.name}</h6>
                            <small class="text-muted">@${comment.username}</small>
                        </a>
                        <p class="card-text mt-1 mb-1">${comment.comments_text}</p>
                        <small class="text-muted d-block">${comment.created_at}</small>
                    </div>
                </div>
            `;
        });

        document.querySelector('.commentsMainBody').innerHTML = comments;


    </script>
</body>
</html>