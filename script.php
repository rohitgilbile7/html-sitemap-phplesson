<?php

add_action('in_admin_footer', 'my_action_javascript'); // Write our JS below here

function my_action_javascript() {
    ?>
        <script type="text/javascript" >
            jQuery(document).ready(function ($) {
                $('#categoryform').submit(function () {
                    var data = {
                        'action': 'submit_Category',
                        'postcategory': $("#postcategory").val()
                    };

                        jQuery.post(ajaxurl, data, function (response) {
                               alert(response);
                        });
                });
                $('#PostForm').submit(function () {
                                var data = {
                                    'action': 'submit_Post',
                                    'publishpost': $("#post").val()
                                };

                        jQuery.post(ajaxurl, data, function (response) {
                             alert(response);
                        });
                });
                $('#pageForm').submit(function () {
                                var data = {
                                    'action': 'submit_Pages',
                                    'publishpages': $("#pages").val()
                                };

                        jQuery.post(ajaxurl, data, function (response) {
                                alert(response);
                        });
                });

    });
        </script>
        <?php

    }
    