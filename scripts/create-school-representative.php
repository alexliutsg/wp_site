<!DOCTYPE html>
<html>
<body>
		<?php
		
		require_once( dirname( __FILE__ ) . '/../wp-blog-header.php' );
		require_once "../wp-includes/user.php";
		
		$email_address = $_POST["email"];
		$user_name = $_POST["username"];
		
		if( null == username_exists( $user_name ) ) {
		  
		  $password = wp_generate_password( 12, false );
		  $user_id = wp_create_user( $user_name, $password, $email_address );
		  
		  wp_update_user(
			array(
			  'ID'          =>    $user_id,
			  'nickname'    =>    $email_address
			)
		  );
		
		$user = new WP_User( $user_id );
		$user->set_role( 'schoolrep' );
		wp_mail( $email_address, 'Welcome!', 'Your Password: ' . $password );
		
		
		global $wpdb;
		
		$wpdb->query( $wpdb->prepare
						( 
                        "
                                INSERT INTO school_rep
                                ( user_id, username, firstname, lastname, id_school )
                                VALUES ( $user_id, '$_POST[username]', '$_POST[firstname]', '$_POST[lastname]', '$_POST[school_id]' )
                        "		
                        ) 
					);
		 
		$wpdb->query( $wpdb->prepare
						( 
                        "
                                INSERT INTO user_school
                                ( user_id, school_id )
                                VALUES ( $user_id, '$_POST[school_id]' )
                        "		
                        ) 
					);
		echo "<h2>Record inserted successfully</h2>";
        
		
		}
		
		?>

</body>
</html>