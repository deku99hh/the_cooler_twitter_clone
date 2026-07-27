<?php require_once( __DIR__ . '\inc\head.php') ?>
<?php require_once( __DIR__ . '\inc\header.php') ?>


<div class="container my-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            
            <h4 class="mb-3 fw-bold">Notifications</h4>

            <div class="notificationsBody"></div>

        </div>
    </div>
</div>


    <script> 
        let res = <?php print_r(json_encode($response)) ?> ;
        console.log(res);

        if (!res.data || !res.data.notifications || res.data.notifications.length === 0) {
            
            document.querySelector('.notificationsBody').innerHTML = `
                <div class="alert alert-info shadow-sm border-0">No new notifications.</div>
            `;

        } else {
            
            let notificationsList = '<div class="list-group shadow-sm border-0">';

            res.data.notifications.reverse().forEach(notification => {
                
                let targetUrl = notification.post_id
                    ? `http://localhost/the_cooler_twitter_clone/Post/open_post/${notification.post_id}` 
                    : `#`;

                notificationsList += `
                    <a href="${targetUrl}" class="list-group-item list-group-item-action p-3 border-bottom">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <p class="mb-0 text-dark font-monospace">${notification.notification_text}</p>
                            ${notification.post_id ? `<small class="text-primary small">View Post →</small>` : ''}
                        </div>
                    </a>
                `;
            });

            notificationsList += '</div>';
            
            document.querySelector('.notificationsBody').innerHTML = notificationsList;
        }

    </script>
</body>
</html>
