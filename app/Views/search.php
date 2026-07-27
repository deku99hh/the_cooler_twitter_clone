<?php require_once( __DIR__ . '\inc\head.php') ?>
<?php require_once( __DIR__ . '\inc\header.php') ?>


<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <div class="postingBox"></div>

            <div class="mainBody">

            </div>

        </div>
    </div>
</div>



    <script> 
        let res = <?php print_r(json_encode($response)) ?> ;
        console.log(res);

        if (res.user_info) {
            let postingBox = `
                <div class="alert alert-light border p-3 mb-4">
                    <h5 class="fw-bold">Welcome, ${res.user_info.name} !</h5>
                    <form action="http://localhost/the_cooler_twitter_clone/Post/makeNewPost" method="POST" class="mt-3">
                        <textarea class="form-control mb-2" name="post_text" rows="3" placeholder="What's happening?" required></textarea>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Post</button>
                    </form>
                </div>
            `
            // document.querySelector('.postingBox').innerHTML = postingBox;
        }

        let posts = "";
        res.data.posts.reverse().forEach(post => {
            let temp = `
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <a href="http://localhost/the_cooler_twitter_clone/Profile/openProfile/${post.user_id}" class="text-decoration-none text-dark">
                            <h6 class="card-title fw-bold mb-0">${post.name}</h6>
                            <small class="text-muted">@${post.username}</small>
                        </a>
                        <p class="card-text mt-2">${post.post_text}</p>
                        <small class="text-muted d-block mb-3">${post.created_at}</small>

                        <div class="d-flex gap-3">
                            <a href="http://localhost/the_cooler_twitter_clone/Post/open_post/${post.post_id}" class="text-decoration-none text-secondary">Comments</a>
                            
                                ${res.user_info ? 
                                    `<a href="http://localhost/the_cooler_twitter_clone/comment/comment/${post.post_id}" class="text-decoration-none text-secondary">Reply</a>
                                    
                                    
                                    <a href="http://localhost/the_cooler_twitter_clone/likes/like/${post.post_id}" class="text-decoration-none">
                                        <button class="btn btn-sm btn-outline-danger">Like</button>
                                    </a> 
                                    <span>${post.total_likes}</span>

                                    <a href="http://localhost/the_cooler_twitter_clone/stars/star/${post.post_id}" class="text-decoration-none">
                                        ${post.is_starred != "0" ? 'stared' : 'not stared'}
                                    </a>

                                ` : ''}
                        </div>
                    </div>
                </div>
            `
            posts += temp;
        });
        document.querySelector('.mainBody').innerHTML = posts;


    </script>
</body>
</html>