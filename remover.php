<?php
// die;
// $delete_me = array();

// foreach($delete_me as $delete_mes)
// {
//     if(file_exists($delete_mes))
//     {
//         unlink ($delete_mes);
//         echo 'Removed '. $delete_mes .filesize($delete_mes)."\n";
//     }
// }

// die;
// $dir = opendir(".");
clearstatcache();
//  echo date("Y-m-d H:i:s");
// $startDate = strtotime("2019-07-12 22:20:00");
$startDate = strtotime("-10 minutes");
// $endDate = strtotime("2019-07-13 00:00:00");
$endDate = time();

/*** the target directory, no trailling slash ***/
$directory = '../';
error_reporting(-1);
ini_set('display_errors', 'On');
// 
// echo filesize('/home4/lybhdumy/public_html/oneprida/wp-includes/Text/Diff/Engine/ztzlgdvb.php'); die;

$globalArrrr = array();
$removeTTT = false;
try
    {
        /*** check if we have a valid directory ***/
        if( !is_dir($directory) )
        {
            throw new Exception('Directory does not exist!'."\n");
        }

        /*** check if we have permission to rename the files ***/
        if( !is_writable( $directory ))
        {
            throw new Exception('You do not have renaming permissions!'."\n");
        }

    
        /**
        *
        * @collapse white space
        *
        * @param string $string
        *
        * @return string
        *
        */
        function collapseWhiteSpace($string)
        {
            return  preg_replace('/\s+/', ' ', $string);
        }

        /**
        * @convert file names to nice names
        *
        * @param string $filename
        *
        * @return string
        *
        */
        
        function endsWith($haystack, $needle)
        {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }
        
            return (substr($haystack, -$length) === $needle);
        }
        
        function safe_names($filename)
        {
            //$filename = collapseWhiteSpace($filename);
            //$filename = str_replace(' ', '-', $filename);
            //$filename = preg_replace('/[^a-z0-9-.]/i','',$filename);
            //return  strtolower($filename);
        }
        
        function delete_all_between($beginning, $end, $string) {
          $beginningPos = strpos($string, $beginning);
          $endPos = strpos($string, $end);
          if ($beginningPos === false || $endPos === false) {
            return $string;
          }
        
          $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
        
          return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
        }

        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, 0));
        /*** loop directly over the object ***/
        while($it->valid())
        {
            /*** check if value is a directory ***/
            if(!$it->isDot())
            {
                if(!is_writable($directory.'/'.$it->getSubPathName()))
                {
                    echo 'Permission Denied: '.$directory.'/'.$it->getSubPathName()."\n";
                }
                else
                {
                    $old_filename = $it->current();
                    $old_file = $directory.'/'.$it->getSubPathName();
                    
                    
                    // $dt = filemtime($old_file);
                    // if ($dt >= $startDate && $dt <= $endDate)
                    // {
                    //     echo $old_file ."\n";
                    // }                    
                    // $tt = $it->getSubPathName();
                    
                    //(filesize($old_file)=="1915") ||
                    if(endsWith($old_filename, '.php'))
                    {
                        $ttt = explode("/",$it->getSubPathName());

                        //$do_not_arr = array('getexcel.php','comments.php','save-sub.php','Password.php','Licenses.php','UserInfo.php','ga_cache.php','advanced.php','layout_4.php','embedded.php','taxonomy.php','save-sub.php','Template.php','generate.php','Iterator.php','Arborize.php','Nofollow.php','Nofollow.php','_sidebar.php','Coverage.php','Bookmark.php','TocEntry.php','optimize.php','checkout.php','Polylang.php','class-wc.php');
                        // $file_sizes = array("1498","2104",)
                        
                        //Verify all PHP files for malwares
                        if(!endsWith($old_filename, 'removefind.php'))
                        {
                            $fileread= file_get_contents($old_file);
                            if(strpos($fileread, 'yourmedsquality') !== false)
                            {
                                $fileread1= file($old_file);
                                echo 'Removed - 12 digit files '. $old_file .filesize($old_file)."\n";
                                echo "\n\n-----------------\n\n";
                                print_r($fileread1);
                                echo "\n\n-----------------\n\n";
                                
                                echo "\n\n-------NEW----------\n\n";
                                // echo "$fileread";
                                $fileread1[0] = "<?php";
                                unset($fileread1[1]);
                                unset($fileread1[2]);
                                print_r($fileread1);
                                echo "\n\n-------NEW----------\n\n";
                                
                                if($removeTTT)
                                {
                                    // file_put_contents($old_file, implode("\r\n", $fileread1));
                                    // $filereadTT= file_get_contents($old_file);
                                    // echo "\n\n-------NEW UPDATED FS----------\n\n";
                                    // echo "$filereadTT";
                                    // echo "\n\n-------NEW UPDATED FS----------\n\n";
                                }
                            }
                        }
                        /*** the old file name ***/
                        // $old_file = $directory.'/'.$it->getSubPathName();
                        // if(filesize($old_file)=="66027")
                        // {
                        //   // echo $old_file."----------------------".filesize($old_file)."\n";
                            
                        //     /*** the new file name ***/
                        //     $new_file = $directory.'/'.$it->getSubPath().'/old-post.php';
                            
                        //     /*** rename the file ***/
                        //     //unlink ($old_file);
        
                        //     /*** a little message to say file is converted ***/
                        //     //echo 'Renamed '. $directory.'/'.$it->getSubPathName() ."\n";
                        //     echo 'Removed '. $old_file ."\n";
                        // }
                        // else
                        // {
                        //     echo 'NNNNNN '. $old_file ."\n";
                        // }
                    }
                }
            }
            /*** move to the next iteration ***/
            $it->next();
        }
        
        /*** when we are all done let the user know ***/
        echo 'Renaming of files complete'."\n";
        print_r(implode("\n",$globalArrrr));
    }
    catch(Exception $e)
    {
        echo $e->getMessage()."\n";
    }
?>
