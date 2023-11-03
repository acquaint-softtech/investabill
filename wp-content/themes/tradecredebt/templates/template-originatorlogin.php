<?php 
/*
Template Name: Originator Login
*/
get_header();
?>


<section class="login_section">
        <div class="container">
            <div class="login_wrap">
                <div class="login_box">
                    <div class="title">
                        <h3>
                            <?php the_title(); ?>
                        </h3>
                    </div>
                    <div class="form_wrap">
                        <form id="originatorlogin_form" class="form">
                            <span class="generalerr generalerror" style="color:#ff2626;margin:0 auto;">Invalid Username/Password</span>
                            <div class="input_group">
                                <label>Username</label>
                                <input type="text" class="input originatorusername" />
                                <span class="generalerr">Please enter a valid username</span>
                            </div>
                            <div class="input_group">
                                <label>Password</label>
                                <input type="password" class="input originatorpassword" />
                                <span class="generalerr">Please enter a valid password</span>
                            </div>
                            <div class="input_group">
                                <button class="btn btn-org">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>