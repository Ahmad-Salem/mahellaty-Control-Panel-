<?php
    session_start();
    include_once("../php_includes/connection_db.php");
    include_once("../php_includes/funtions.php");
    check_login("../login/login.php","يجب أن تسجل الدخول أولا");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--IE compatibility Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- first mobile meta --> 
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>محلاتي</title>

        <!-- Bootstrap -->
        <script src="../javascript/jquery-2.1.1.min.js"></script>  
        <link rel="stylesheet" href="../css/bootstrap.css" />  
        <script src="../javascript/jquery_ui.js"></script> 
        <link rel="stylesheet" href="../css/jquery_ui.css">
        <!-- fontawsome  -->
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <!-- My Css style -->
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/pop_up.css" />
        <!-- My Media style -->
        <link  rel="stylesheet" href="../css/media.css" />
        
        <!-- [if it ie 9] -->
            <script src="../javascript/html5shiv.min.js"></script>
            <script src="../javascript/respond.min.js"></script>
        <!-- [end if] -->

        
        
    </head>
    <body>

        <!-- datepicker script -->
        <script>  
        
          $(document).ready(function(){  
             $.datepicker.setDefaults({  
                  dateFormat: 'yy-mm-dd'   
             });  
             $(function(){  
                  $("#add_advertisement_duration_from").datepicker();
                  $("#add_advertisement_duration_to").datepicker();   
             });

          });
        </script>
        <!-- datepicker script -->

        

        <!-- start section header -->
        <div class="header">
            <div class="container">
                <div class="logo">
                    <i class="fa fa-shopping-basket fa-x3"></i>
                    <span>محلاتي</span>
                </div>
                <div class="settings">
                    <a href="#"><i class="fa fa-bell fa-lg"></i></a>
                    <a href="#" id="logout">...</a>
                </div>
            </div>
        </div>
        <!-- end section header -->
        <!-- start section body -->
        <div class="clear"></div>
        <div class="body_content container" >
        
            <?php
                $advertisement_id=$_GET['ad_id'];
                $query_get_advertisement_paid="SELECT `id`, `advertise_photo`, `gov`, `city`, `cost`, `from_date`, `to_date`, `activated` FROM `advertisement_paid` WHERE `id`='{$advertisement_id}' LIMIT 1";
                
                $perform_query_get_advertisement_paid=mysqli_query($connect,$query_get_advertisement_paid);
                $adver_paid_row=mysqli_fetch_assoc($perform_query_get_advertisement_paid);
                $myDateTime1 = DateTime::createFromFormat('Y-m-d', $adver_paid_row['from_date']);
                $myDateTime2 = DateTime::createFromFormat('Y-m-d', $adver_paid_row['to_date']);
                
            ?>
            <div class="add_user add_shop">
                <form action="edit_advertisement_background.php" method="POST" id="add_advertisement_submit" enctype="multipart/form-data">
                    <h4 class="text-center">تعديل بيانات الاعلان  الممول</h4>
                        <br/>
                        <input type="text" id="add_advertisement_duration_from"  placeholder="تاريخ بداية الاعلان "  name="add_advertisement_duration_from" class="from_date input form-control" value="<?php echo date_format($myDateTime1, "Y-m-d"); ?>"/>
                        <br/><br/>
                        <p class="error" id="Error_advertisement_duration_from">خطأ كبير يا نجم</p>
                        
                        <br/>
                        <br/>
                        <input type="text" id="add_advertisement_duration_to" value="<?php echo date_format($myDateTime2, "Y-m-d");?>"   placeholder="تاريخ انتهاء الاعلان"  name="add_advertisement_duration_to" class="from_date input form-control" />
                        <br/><br/>
                        <p class="error" id="Error_advertisement_duration_to">خطأ كبير يا نجم</p>
                        
                        <br/>
                        <input type="text" id="add_advertisement_cost" value="<?php echo $adver_paid_row['cost']?>"  placeholder="أدخل  تكلفة الاعلان بالجنيه المصري"  name="add_advertisement_cost" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_advertisement_cost">خطأ كبير يا نجم</p>
                        

                        <div class="upload_photo_container">
                            <img src="<?php echo "../images/advertisement_paid/{$adver_paid_row['id']}/{$adver_paid_row['advertise_photo']}"; ?>" class="image_preview"/>
                             
                        <div class="file-input wrapper photo_btn">
                                               
                                <input id="add_advertisement_photo" type="file" name="add_advertisement_photo"  class="file-input control" />
                                <div class="file-input content">
                                    <div class="upload_image_box">
                                    <h4 class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تحميل صورة الاعلان</h4>
                                    </div> 
                                </div>
                         </div>
                     
                        </div>
                         <p class="error" id="Error_advertisement_photo">خطأ كبير يا نجم</p>
                         <br/>
                         <!-- government type-->
                          <!-- user type-->
                          <div class="kind">
                            <select id="add_government" name="government" >
                                <option selected disabled value>أختر المحافظة</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة القاهرة"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة القاهرة">محافظة القاهرة</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الجِيزَة"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الجِيزَة">محافظة الجِيزَة</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة القليوبية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة القليوبية">محافظة القليوبية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الإسكندرية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الإسكندرية">محافظة الإسكندرية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة البحيرة"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة البحيرة">محافظة البحيرة</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة مطروح"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة مطروح">محافظة مطروح</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة دمياط"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة دمياط">محافظة دمياط</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الدقهلية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الدقهلية">محافظة الدقهلية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة كفر الشيخ"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة كفر الشيخ">محافظة كفر الشيخ</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الغربية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الغربية">محافظة الغربية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة المنوفية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة المنوفية">محافظة المنوفية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الشرقية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الشرقية">محافظة الشرقية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة بورسعيد"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة بورسعيد">محافظة بورسعيد</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الإسماعيلية"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الإسماعيلية">محافظة الإسماعيلية</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة السويس"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة السويس">محافظة السويس</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة شمال سيناء"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة شمال سيناء">محافظة شمال سيناء</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة جنوب سيناء"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة جنوب سيناء">محافظة جنوب سيناء</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة بني سويف"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة بني سويف">محافظة بني سويف</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الفيوم"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الفيوم">محافظة الفيوم</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة المنيا"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة المنيا">محافظة المنيا</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة أسيوط"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة أسيوط">محافظة أسيوط</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة البحر الأحمر"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة البحر الأحمر">محافظة البحر الأحمر</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة سوهاج"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة سوهاج">محافظة سوهاج</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة قنا"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة قنا">محافظة قنا</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة الأقصر"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة الأقصر">محافظة الأقصر</option>
                                <option 
                                <?php if($adver_paid_row['gov']=="محافظة أَسْوان"):?>
                                     selected
                                <?php endif;?>
                                value="محافظة أَسْوان">محافظة أَسْوان</option>
                            </select>             
                         </div>  
                       
                           <p class="error" id="Error_government">خطأ كبير يا نجم</p>
                        <br/>

                        <!-- city type-->
                        <div class="kind">
                            <select id="add_city" name="city" >
                                <option selected disabled value>أختر المدينة</option>
                                <option disabled value>محافظة القاهرة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الزيتون"):?>
                                     selected
                                <?php endif;?>
                                value="حي الزيتون">حي الزيتون</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الزاوية الحمراء"):?>
                                     selected
                                <?php endif;?>
                                value="حي الزاوية الحمراء">حي الزاوية الحمراء</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي حدائق القبة"):?>
                                     selected
                                <?php endif;?>
                                value="حي حدائق القبة">حي حدائق القبة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الشرابية"):?>
                                     selected
                                <?php endif;?>
                                value="حي الشرابية">حي الشرابية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الساحل"):?>
                                     selected
                                <?php endif;?>
                                value="حي الساحل">حي الساحل</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي شبرا"):?>
                                     selected
                                <?php endif;?>
                                value="حي شبرا">حي شبرا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي روض الفرج"):?>
                                     selected
                                <?php endif;?>
                                value="حي روض الفرج">حي روض الفرج</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الأميرية"):?>
                                     selected
                                <?php endif;?>
                                value="حي الأميرية">حي الأميرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي السلام أول"):?>
                                     selected
                                <?php endif;?>
                                value="حي السلام أول">حي السلام أول</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي السلام ثان"):?>
                                     selected
                                <?php endif;?>
                                value="حي السلام ثان">حي السلام ثان</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي المرج"):?>
                                     selected
                                <?php endif;?>
                                value="حي المرج">حي المرج</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي المطرية"):?>
                                     selected
                                <?php endif;?>  
                                value="حي المطرية">حي المطرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي عين شمس"):?>
                                     selected
                                <?php endif;?>
                                value="حي عين شمس">حي عين شمس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي النزهة"):?>
                                     selected
                                <?php endif;?>
                                value="حي النزهة">حي النزهة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي مصر الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="حي مصر الجديدة">حي مصر الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي شرق مدينة نصر"):?>
                                     selected
                                <?php endif;?>
                                value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي غرب مدينة نصر"):?>
                                     selected
                                <?php endif;?>
                                value="حي غرب مدينة نصر">حي غرب مدينة نصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الوايلي"):?>
                                     selected
                                <?php endif;?>
                                value="حي الوايلي">حي الوايلي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي منشأة ناصر"):?>
                                     selected
                                <?php endif;?>
                                value="حي منشأة ناصر">حي منشأة ناصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي وسط"):?>
                                     selected
                                <?php endif;?>
                                value="حي وسط">حي وسط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي باب الشعرية"):?>
                                     selected
                                <?php endif;?>
                                value="حي باب الشعرية">حي باب الشعرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الأزبكية"):?>
                                     selected
                                <?php endif;?>
                                value="حي الأزبكية">حي الأزبكية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي بولاق"):?>
                                     selected
                                <?php endif;?>
                                value="حي بولاق">حي بولاق</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الموسكي"):?>
                                     selected
                                <?php endif;?>
                                value="حي الموسكي">حي الموسكي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي عابدين"):?>
                                     selected
                                <?php endif;?>
                                value="حي عابدين">حي عابدين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي غرب"):?>
                                     selected
                                <?php endif;?>
                                value="حي غرب">حي غرب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي المقطم"):?>
                                     selected
                                <?php endif;?>
                                value="حي المقطم">حي المقطم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي الخليفة"):?>
                                     selected
                                <?php endif;?>
                                value="حي الخليفة">حي الخليفة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي السيدة زينب"):?>
                                     selected
                                <?php endif;?>
                                value="حي السيدة زينب">حي السيدة زينب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي مصر القديمة"):?>
                                     selected
                                <?php endif;?>
                                value="حي مصر القديمة">حي مصر القديمة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي دار السلام"):?>
                                     selected
                                <?php endif;?>
                                value="حي دار السلام">حي دار السلام</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي البساتين"):?>
                                     selected
                                <?php endif;?>
                                value="حي البساتين">حي البساتين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي المعادي"):?>
                                     selected
                                <?php endif;?>
                                value="حي المعادي">حي المعادي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي طره"):?>
                                     selected
                                <?php endif;?>
                                value="حي طره">حي طره</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي المعصرة"):?>
                                     selected
                                <?php endif;?>
                                value="حي المعصرة">حي المعصرة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي 15 مايو"):?>
                                     selected
                                <?php endif;?>
                                value="حي 15 مايو">حي 15 مايو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي حلوان"):?>
                                     selected
                                <?php endif;?>
                                value="حي حلوان">حي حلوان</option>
                                <option
                                <?php if($adver_paid_row['city']=="حي التبين"):?>
                                     selected
                                <?php endif;?>
                                value="حي التبين">حي التبين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حي شرق مدينة نصر"):?>
                                     selected
                                <?php endif;?>
                                value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القاهرة الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="القاهرة الجديدة">القاهرة الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بدر"):?>
                                     selected
                                <?php endif;?>
                                value="بدر">بدر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الشروق"):?>
                                     selected
                                <?php endif;?>
                                value="الشروق">الشروق</option>
                                <option disabled value>محافظة الجِيزَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الجِيزَة"):?>
                                     selected
                                <?php endif;?>
                                value="الجِيزَة">الجِيزَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السادس من أكتوبر"):?>
                                     selected
                                <?php endif;?>
                                value="السادس من أكتوبر">السادس من أكتوبر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الشيخ زايد"):?>
                                     selected
                                <?php endif;?>
                                value="الشيخ زايد">الشيخ زايد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الحَوامْدِيّة"):?>
                                     selected
                                <?php endif;?>
                                value="الحَوامْدِيّة">الحَوامْدِيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="البَدْرْشِين"):?>
                                     selected
                                <?php endif;?>
                                value="البَدْرْشِين">البَدْرْشِين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الصَّف"):?>
                                     selected
                                <?php endif;?>
                                value="الصَّف">الصَّف</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أطْفِيح"):?>
                                     selected
                                <?php endif;?>
                                value="أطْفِيح">أطْفِيح</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العَيَّاط"):?>
                                     selected
                                <?php endif;?>
                                value="العَيَّاط">العَيَّاط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الباويطي"):?>
                                     selected
                                <?php endif;?>
                                value="الباويطي">الباويطي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="منشأة القناطر"):?>
                                     selected
                                <?php endif;?>
                                value="منشأة القناطر">منشأة القناطر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أَوْسِيم"):?>
                                     selected
                                <?php endif;?>
                                value="أَوْسِيم">أَوْسِيم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كِرْداسَة"):?>
                                     selected
                                <?php endif;?>
                                value="كِرْداسَة">كِرْداسَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو النُمْرُس"):?>
                                     selected
                                <?php endif;?>
                                value="أبو النُمْرُس">أبو النُمْرُس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر غطاطي ومنشأة البكاري"):?>
                                     selected
                                <?php endif;?>
                                value="كفر غطاطي ومنشأة البكاري">كفر غطاطي ومنشأة البكاري</option>
                                <option disabled value>محافظة القليوبية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بَنْها"):?>
                                     selected
                                <?php endif;?>
                                value="بَنْها">بَنْها</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قَلْيوب"):?>
                                     selected
                                <?php endif;?>
                                value="قَلْيوب">قَلْيوب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شُبْرا الخيمة"):?>
                                     selected
                                <?php endif;?>
                                value="شُبْرا الخيمة">شُبْرا الخيمة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القناطر الخيرية"):?>
                                     selected
                                <?php endif;?>
                                value="القناطر الخيرية">القناطر الخيرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الخْانْكَة"):?>
                                     selected
                                <?php endif;?>
                                value="الخْانْكَة">الخْانْكَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر شُكر"):?>
                                     selected
                                <?php endif;?>
                                value="كفر شُكر">كفر شُكر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طُوخ"):?>
                                     selected
                                <?php endif;?>
                                value="طُوخ">طُوخ</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قَها"):?>
                                     selected
                                <?php endif;?>
                                value="قَها">قَها</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العبور"):?>
                                     selected
                                <?php endif;?>
                                value="العبور">العبور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الخُصُوص"):?>
                                     selected
                                <?php endif;?>
                                value="الخُصُوص">الخُصُوص</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شِبِين القناطر"):?>
                                     selected
                                <?php endif;?>
                                value="شِبِين القناطر">شِبِين القناطر</option>
                                <option disabled value>محافظة الإسكندرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الإسكندرية"):?>
                                     selected
                                <?php endif;?>
                                value="الإسكندرية">الإسكندرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="برج العرب"):?>
                                     selected
                                <?php endif;?>
                                value="برج العرب">برج العرب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="برج العرب الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="برج العرب الجديدة">برج العرب الجديدة</option>
                                <option disabled value>محافظة البحيرة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دَمَنْهور"):?>
                                     selected
                                <?php endif;?>
                                value="دَمَنْهور">دَمَنْهور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر الدَّوَّار"):?>
                                     selected
                                <?php endif;?>
                                value="كفر الدَّوَّار">كفر الدَّوَّار</option>
                                <option 
                                <?php if($adver_paid_row['city']=="رَشيد"):?>
                                     selected
                                <?php endif;?>
                                value="رَشيد">رَشيد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إدكو"):?>
                                     selected
                                <?php endif;?>
                                value="إدكو">إدكو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو المطامير"):?>
                                     selected
                                <?php endif;?>
                                value="أبو المطامير">أبو المطامير</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو حُمُّص"):?>
                                     selected
                                <?php endif;?>
                                value="أبو حُمُّص">أبو حُمُّص</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الدِّلنْجات"):?>
                                     selected
                                <?php endif;?>
                                value="الدِّلنْجات">الدِّلنْجات</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المحموديّة"):?>
                                     selected
                                <?php endif;?>
                                value="المحموديّة">المحموديّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الرحمانيّة"):?>
                                     selected
                                <?php endif;?>
                                value="الرحمانيّة">الرحمانيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إيتاي البارود"):?>
                                     selected
                                <?php endif;?>
                                value="إيتاي البارود">إيتاي البارود</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حُوش عيسى"):?>
                                     selected
                                <?php endif;?>
                                value="حُوش عيسى">حُوش عيسى</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شُبراخِيت"):?>
                                     selected
                                <?php endif;?>
                                value="شُبراخِيت">شُبراخِيت</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كوم حمادة"):?>
                                     selected
                                <?php endif;?>
                                value="كوم حمادة">كوم حمادة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بدر"):?>
                                     selected
                                <?php endif;?>
                                value="بدر">بدر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="وادي النَطْرون"):?>
                                     selected
                                <?php endif;?>
                                value="وادي النَطْرون">وادي النَطْرون</option>
                                <option 
                                <?php if($adver_paid_row['city']=="النُوبَاريّة الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="النُوبَاريّة الجديدة">النُوبَاريّة الجديدة</option>
                                <option disabled value>محافظة مطروح</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مَرْسَى مَطْرُوح"):?>
                                     selected
                                <?php endif;?>
                                value="مَرْسَى مَطْرُوح">مَرْسَى مَطْرُوح</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الحَمَّام"):?>
                                     selected
                                <?php endif;?>
                                value="الحَمَّام">الحَمَّام</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العَلَمِين"):?>
                                     selected
                                <?php endif;?>
                                value="العَلَمِين">العَلَمِين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الضَّبْعَة"):?>
                                     selected
                                <?php endif;?>
                                value="الضَّبْعَة">الضَّبْعَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="النِّجِيلَة"):?>
                                     selected
                                <?php endif;?>
                                value="النِّجِيلَة">النِّجِيلَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سِيِدي بَرَّانِي"):?>
                                     selected
                                <?php endif;?>
                                value="سِيِدي بَرَّانِي">سِيِدي بَرَّانِي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السَّلُّوم"):?>
                                     selected
                                <?php endif;?>
                                value="السَّلُّوم">السَّلُّوم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سِيوَة"):?>
                                     selected
                                <?php endif;?>
                                value="سِيوَة">سِيوَة</option>
                                <option disabled value>محافظة دمياط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دمياط"):?>
                                     selected
                                <?php endif;?>
                                value="دمياط">دمياط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دمياط الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="دمياط الجديدة">دمياط الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="رأس البر"):?>
                                     selected
                                <?php endif;?>
                                value="رأس البر">رأس البر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="فارسكور"):?>
                                     selected
                                <?php endif;?>
                                value="فارسكور">فارسكور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر سعد"):?>
                                     selected
                                <?php endif;?>  
                                value="كفر سعد">كفر سعد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الزرقا"):?>
                                     selected
                                <?php endif;?>
                                value="الزرقا">الزرقا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السرو"):?>
                                     selected
                                <?php endif;?>
                                value="السرو">السرو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الروضة"):?>
                                     selected
                                <?php endif;?>
                                value="الروضة">الروضة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر البطيخ"):?>
                                     selected
                                <?php endif;?>
                                value="كفر البطيخ">كفر البطيخ</option>
                                <option 
                                <?php if($adver_paid_row['city']=="عزبة البرج"):?>
                                     selected
                                <?php endif;?>
                                value="عزبة البرج">عزبة البرج</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ميت أبو غالب"):?>
                                     selected
                                <?php endif;?>
                                value="ميت أبو غالب">ميت أبو غالب</option>
                                <option disabled value>محافظة الدقهلية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المنصورة"):?>
                                     selected
                                <?php endif;?>
                                value="المنصورة">المنصورة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طَلْخا"):?>
                                     selected
                                <?php endif;?>
                                value="طَلْخا">طَلْخا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ميت غمر"):?>
                                     selected
                                <?php endif;?>
                                value="ميت غمر">ميت غمر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دِكِرِنْس"):?>
                                     selected
                                <?php endif;?>
                                value="دِكِرِنْس">دِكِرِنْس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أجا"):?>
                                     selected
                                <?php endif;?>
                                value="أجا">أجا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="منية النصر"):?>
                                     selected
                                <?php endif;?>
                                value="منية النصر">منية النصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السنبلاوين"):?>
                                     selected
                                <?php endif;?>
                                value="السنبلاوين">السنبلاوين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الكردي"):?>
                                     selected
                                <?php endif;?>
                                value="الكردي">الكردي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بني عبيد"):?>
                                     selected
                                <?php endif;?>
                                value="بني عبيد">بني عبيد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المنزلة"):?>
                                     selected
                                <?php endif;?>
                                value="المنزلة">المنزلة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="تمي الأمديد"):?>
                                     selected
                                <?php endif;?>
                                value="تمي الأمديد">تمي الأمديد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الجمالية"):?>
                                     selected
                                <?php endif;?>
                                value="الجمالية">الجمالية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شربين"):?>
                                     selected
                                <?php endif;?>
                                value="شربين">شربين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="El mataraya"):?>
                                     selected
                                <?php endif;?>
                                value="المطرية">المطرية</option>
                                <option   
                                <?php if($adver_paid_row['city']=="بلقاس"):?>
                                     selected
                                <?php endif;?>
                                value="بلقاس">بلقاس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ميت سلسيل"):?>
                                     selected
                                <?php endif;?>
                                value="ميت سلسيل">ميت سلسيل</option>
                                <option 
                                <?php if($adver_paid_row['city']=="جمصة"):?>
                                     selected
                                <?php endif;?>
                                value="جمصة">جمصة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="محلة دمنة"):?>
                                     selected
                                <?php endif;?>
                                value="محلة دمنة">محلة دمنة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نبروه"):?>
                                     selected
                                <?php endif;?>
                                value="نبروه">نبروه</option>
                                <option disabled value>محافظة كفر الشيخ</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر الشيخ"):?>
                                     selected
                                <?php endif;?>
                                value="كفر الشيخ">كفر الشيخ</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دِسوق"):?>
                                     selected
                                <?php endif;?>
                                value="دِسوق">دِسوق</option>
                                <option 
                                <?php if($adver_paid_row['city']=="فُوّه"):?>
                                     selected
                                <?php endif;?>
                                value="فُوّه">فُوّه</option>
                                <option   
                                <?php if($adver_paid_row['city']=="مِطوُبِس"):?>
                                     selected
                                <?php endif;?>
                                value="مِطوُبِس">مِطوُبِس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بَلْطيم"):?>
                                     selected
                                <?php endif;?>
                                value="بَلْطيم">بَلْطيم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مصيف بَلْطيم"):?>
                                     selected
                                <?php endif;?>
                                value="مصيف بَلْطيم">مصيف بَلْطيم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الحامول"):?>
                                     selected
                                <?php endif;?>
                                value="الحامول">الحامول</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بِيَلا"):?>
                                     selected
                                <?php endif;?>
                                value="بِيَلا">بِيَلا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الرياض"):?>
                                     selected
                                <?php endif;?>
                                value="الرياض">الرياض</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سيدي سالم"):?>
                                     selected
                                <?php endif;?>
                                value="سيدي سالم">سيدي سالم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قَلّين"):?>
                                     selected
                                <?php endif;?>
                                value="قَلّين">قَلّين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سيدي غازي"):?>
                                     selected
                                <?php endif;?>
                                value="سيدي غازي">سيدي غازي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بُرج البُرلُّس"):?>
                                     selected
                                <?php endif;?>
                                value="بُرج البُرلُّس">بُرج البُرلُّس</option>
                                <option disabled value>محافظة الغربية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طنْطَا"):?>
                                     selected
                                <?php endif;?>
                                value="طنْطَا">طنْطَا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المحلة الكبرى"):?>
                                     selected
                                <?php endif;?>
                                value="المحلة الكبرى">المحلة الكبرى</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر الزَّيَّات"):?>
                                     selected
                                <?php endif;?>
                                value="كفر الزَّيَّات">كفر الزَّيَّات</option>
                                <option 
                                <?php if($adver_paid_row['city']=="زِفْتى"):?>
                                     selected
                                <?php endif;?>
                                value="زِفْتى">زِفْتى</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السّنْطة"):?>
                                     selected
                                <?php endif;?>
                                value="السّنْطة">السّنْطة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قُطور"):?>
                                     selected
                                <?php endif;?>
                                value="قُطور">قُطور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بَسْيون"):?>
                                     selected
                                <?php endif;?>
                                value="بَسْيون">بَسْيون</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سَمَنُّود"):?>
                                     selected
                                <?php endif;?>
                                value="سَمَنُّود">سَمَنُّود</option>
                                <option disabled value>محافظة المنوفية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شِبين الكوم"):?>
                                     selected
                                <?php endif;?>
                                value="شِبين الكوم">شِبين الكوم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مدينة السادات"):?>
                                     selected
                                <?php endif;?>
                                value="مدينة السادات">مدينة السادات</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مِنُوف"):?>
                                     selected
                                <?php endif;?>
                                value="مِنُوف">مِنُوف</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سِرس الليَّان"):?>
                                     selected
                                <?php endif;?>
                                value="سِرس الليَّان">سِرس الليَّان</option>
                                <option 
                                <?php if($adver_paid_row['city']=="َشْمُون"):?>
                                     selected
                                <?php endif;?>
                                value="َشْمُون">أَشْمُون</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الباجور"):?>
                                     selected
                                <?php endif;?>
                                value="الباجور">الباجور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ُوِيْسنا"):?>
                                     selected
                                <?php endif;?>
                                value="ُوِيْسنا">ُوِيْسنا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بركة السبع"):?>
                                     selected
                                <?php endif;?>
                                value="بركة السبع">بركة السبع</option>
                                <option 
                                <?php if($adver_paid_row['city']=="تَلَا"):?>
                                     selected
                                <?php endif;?>
                                value="تَلَا">تَلَا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الشهداء"):?>
                                     selected
                                <?php endif;?>
                                value="الشهداء">الشهداء</option>
                                <option disabled value>محافظة الشرقية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الزقازيق"):?>
                                     selected
                                <?php endif;?>
                                value="الزقازيق">الزقازيق</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العاشر من رمضان"):?>
                                     selected
                                <?php endif;?>
                                value="العاشر من رمضان">العاشر من رمضان</option>
                                <option 
                                <?php if($adver_paid_row['city']=="منيا القمح"):?>
                                     selected
                                <?php endif;?>
                                value="منيا القمح">منيا القمح</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بِلْبيس"):?>
                                     selected
                                <?php endif;?>
                                value="بِلْبيس">بِلْبيس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مشتول السوق"):?>
                                     selected
                                <?php endif;?>
                                value="مشتول السوق">مشتول السوق</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القنايات"):?>
                                     selected
                                <?php endif;?>
                                value="القنايات">القنايات</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو حمّاد"):?>
                                     selected
                                <?php endif;?>
                                value="أبو حمّاد">أبو حمّاد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="El qureen"):?>
                                     selected
                                <?php endif;?>
                                value="El qureen">القُرين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="هِهْيا"):?>
                                     selected
                                <?php endif;?>
                                value="هِهْيا">هِهْيا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو كبير"):?>
                                     selected
                                <?php endif;?>
                                value="أبو كبير">أبو كبير</option>
                                <option 
                                <?php if($adver_paid_row['city']=="فاقوس"):?>
                                     selected
                                <?php endif;?>
                                value="فاقوس">فاقوس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الصالحية الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="الصالحية الجديدة">الصالحية الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الإبراهيمية"):?>
                                     selected
                                <?php endif;?>
                                value="الإبراهيمية">الإبراهيمية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ديرب نجم"):?>
                                     selected
                                <?php endif;?>
                                value="ديرب نجم">ديرب نجم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كفر صقر"):?>
                                     selected
                                <?php endif;?>
                                value="كفر صقر">كفر صقر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أولاد صقر"):?>
                                     selected
                                <?php endif;?>
                                value="أولاد صقر">أولاد صقر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الحسينية"):?>
                                     selected
                                <?php endif;?>
                                value="الحسينية">الحسينية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="صان الحجر القبلية"):?>
                                     selected
                                <?php endif;?>
                                value="صان الحجر القبلية">صان الحجر القبلية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="منشأة أبو عمر"):?>
                                     selected
                                <?php endif;?>
                                value="منشأة أبو عمر">منشأة أبو عمر</option>
                                <option disabled value>محافظة بورسعيد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بورسعيد"):?>
                                     selected
                                <?php endif;?>
                                value="بورسعيد">بورسعيد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بورفؤاد"):?>
                                     selected
                                <?php endif;?>
                                value="بورفؤاد">بورفؤاد</option>
                                <option disabled value>محافظة الإسماعيلية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الإسماعيلية"):?>
                                     selected
                                <?php endif;?>
                                value="الإسماعيلية">الإسماعيلية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="فايد"):?>
                                     selected
                                <?php endif;?>
                                value="فايد">فايد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القنطرة شرق"):?>
                                     selected
                                <?php endif;?>
                                value="القنطرة شرق">القنطرة شرق</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القنطرة غرب"):?>
                                     selected
                                <?php endif;?>
                                value="القنطرة غرب">القنطرة غرب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="التل الكبير"):?>
                                     selected
                                <?php endif;?>
                                value="التل الكبير">التل الكبير</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو صوير المحطة"):?>
                                     selected
                                <?php endif;?>
                                value="أبو صوير المحطة">أبو صوير المحطة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القصاصين الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="القصاصين الجديدة">القصاصين الجديدة</option>
                                <option disabled value>محافظة السويس</option>
                                <option   
                                <?php if($adver_paid_row['city']=="السويس"):?>
                                     selected
                                <?php endif;?>
                                value="السويس">السويس</option>
                                <option disabled value>محافظة شمال سيناء</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العريش"):?>
                                     selected
                                <?php endif;?>
                                value="العريش">العريش</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الشّيخ زُوَيِّد"):?>
                                     selected
                                <?php endif;?>
                                value="الشّيخ زُوَيِّد">الشّيخ زُوَيِّد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="رَفَح"):?>
                                     selected
                                <?php endif;?>
                                value="رَفَح">رَفَح</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بئر العبد"):?>
                                     selected
                                <?php endif;?>
                                value="بئر العبد">بئر العبد</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الحَسَنَة"):?>
                                     selected
                                <?php endif;?>
                                value="الحَسَنَة">الحَسَنَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نَخِل"):?>
                                     selected
                                <?php endif;?>
                                value="نَخِل">نَخِل</option>
                                <option disabled value>محافظة جنوب سيناء</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الطور"):?>
                                     selected
                                <?php endif;?>
                                value="الطور">الطور</option>
                                <option 
                                <?php if($adver_paid_row['city']=="شرم الشيخ"):?>
                                     selected
                                <?php endif;?>
                                value="شرم الشيخ">شرم الشيخ</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دهب"):?>
                                     selected
                                <?php endif;?>
                                value="دهب">دهب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نويبع"):?>
                                     selected
                                <?php endif;?>
                                value="نويبع">نويبع</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طابا"):?>
                                     selected
                                <?php endif;?>
                                value="طابا">طابا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سانت كاترين"):?>
                                     selected
                                <?php endif;?>
                                value="سانت كاترين">سانت كاترين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو رديس"):?>
                                     selected
                                <?php endif;?>
                                value="أبو رديس">أبو رديس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو زنيمة"):?>
                                     selected
                                <?php endif;?>
                                value="أبو زنيمة">أبو زنيمة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="رأس سدر"):?>
                                     selected
                                <?php endif;?>
                                value="رأس سدر">رأس سدر</option>
                                <option disabled value>محافظة بني سويف</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بني سويف"):?>
                                     selected
                                <?php endif;?>
                                value="بني سويف">بني سويف</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بني سويف الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="بني سويف الجديدة">بني سويف الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الواسْطَى"):?>
                                     selected
                                <?php endif;?>
                                value="الواسْطَى">الواسْطَى</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ناصر"):?>
                                     selected
                                <?php endif;?>
                                value="ناصر">ناصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إهناسيا"):?>
                                     selected
                                <?php endif;?>
                                value="إهناسيا">إهناسيا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بِبا"):?>
                                     selected
                                <?php endif;?>
                                value="بِبا">بِبا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سمسطا"):?>
                                     selected
                                <?php endif;?>
                                value="سمسطا">سمسطا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الفَشْن"):?>
                                     selected
                                <?php endif;?>
                                value="الفَشْن">الفَشْن</option>
                                <option disabled value>محافظة الفيوم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الفُيُّوم"):?>
                                     selected
                                <?php endif;?>
                                value="الفُيُّوم">الفُيُّوم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الفُيُّوم الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="الفُيُّوم الجديدة">الفُيُّوم الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طَامِيِّة"):?>
                                     selected
                                <?php endif;?>
                                value="طَامِيِّة">طَامِيِّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سنورس"):?>
                                     selected
                                <?php endif;?>
                                value="سنورس">سنورس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إطسا"):?>
                                     selected
                                <?php endif;?>
                                value="إطسا">إطسا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إبشواي"):?>
                                     selected
                                <?php endif;?>
                                value="إبشواي">إبشواي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="يوسف الصديق"):?>
                                     selected
                                <?php endif;?>
                                value="يوسف الصديق">يوسف الصديق</option>
                                <option disabled value>محافظة المنيا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المنيا"):?>
                                     selected
                                <?php endif;?>
                                value="المنيا">المنيا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المنيا الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="المنيا الجديدة">المنيا الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="العدوة"):?>
                                     selected
                                <?php endif;?>
                                value="العدوة">العدوة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مَغَاغَة"):?>
                                     selected
                                <?php endif;?>
                                value="مَغَاغَة">مَغَاغَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بني مزار"):?>
                                     selected
                                <?php endif;?>
                                value="بني مزار">بني مزار</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مَطَاي"):?>
                                     selected
                                <?php endif;?>
                                value="مَطَاي">مَطَاي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سَمَالُوط"):?>
                                     selected
                                <?php endif;?>
                                value="سَمَالُوط">سَمَالُوط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المدينة الفكرية"):?>
                                     selected
                                <?php endif;?>
                                value="المدينة الفكرية">المدينة الفكرية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مَلّوي"):?>
                                     selected
                                <?php endif;?>
                                value="مَلّوي">مَلّوي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دِير مَوَاس"):?>
                                     selected
                                <?php endif;?>
                                value="دِير مَوَاس">دِير مَوَاس</option>
                                <option disabled value>محافظة أسيوط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الخَارْجَة"):?>
                                     selected
                                <?php endif;?>
                                value="الخَارْجَة">الخَارْجَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="باريس"):?>
                                     selected
                                <?php endif;?>
                                value="باريس">باريس</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مُوط"):?>
                                     selected
                                <?php endif;?>
                                value="مُوط">مُوط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الفرافرة"):?>
                                     selected
                                <?php endif;?>
                                value="الفرافرة">الفرافرة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="بلاط"):?>
                                     selected
                                <?php endif;?>
                                value="بلاط">بلاط</option>
                                <option disabled value>محافظة البحر الأحمر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الغردقة"):?>
                                     selected
                                <?php endif;?>
                                value="الغردقة">الغردقة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="رأس غارب"):?>
                                     selected
                                <?php endif;?>
                                value="رأس غارب">رأس غارب</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سفاجا"):?>
                                     selected
                                <?php endif;?>
                                value="سفاجا">سفاجا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القصير"):?>
                                     selected
                                <?php endif;?>
                                value="القصير">القصير</option>
                                <option 
                                <?php if($adver_paid_row['city']=="مرسى علم"):?>
                                     selected
                                <?php endif;?>
                                value="مرسى علم">مرسى علم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الشلاتين"):?>
                                     selected
                                <?php endif;?>
                                value="الشلاتين">الشلاتين</option>
                                <option 
                                <?php if($adver_paid_row['city']=="حلايب"):?>
                                     selected
                                <?php endif;?>
                                value="حلايب">حلايب</option>
                                <option disabled value>محافظة سوهاج</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سُوهَاج"):?>
                                     selected
                                <?php endif;?>
                                value="سُوهَاج">سُوهَاج</option>
                                <option 
                                <?php if($adver_paid_row['city']=="سوهاج الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="سوهاج الجديدة">سوهاج الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أخميم"):?>
                                     selected
                                <?php endif;?>
                                value="أخميم">أخميم</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أخميم الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="أخميم الجديدة">أخميم الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="البلْيَنا"):?>
                                     selected
                                <?php endif;?>
                                value="البلْيَنا">البلْيَنا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المراغة"):?>
                                     selected
                                <?php endif;?>
                                value="المراغة">المراغة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="المنشأة"):?>
                                     selected
                                <?php endif;?>
                                value="المنشأة">المنشأة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دار السلام"):?>
                                     selected
                                <?php endif;?>
                                value="دار السلام">دار السلام</option>
                                <option 
                                <?php if($adver_paid_row['city']=="جِرجا"):?>
                                     selected
                                <?php endif;?>
                                value="جِرجا">جِرجا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="جُهِينَة الغربيّة"):?>
                                     selected
                                <?php endif;?>
                                value="جُهِينَة الغربيّة">جُهِينَة الغربيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="ساقلته"):?>
                                     selected
                                <?php endif;?>
                                value="ساقلته">ساقلته</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طمَا"):?>
                                     selected
                                <?php endif;?>
                                value="طمَا">طمَا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طَهُطَا"):?>
                                     selected
                                <?php endif;?>
                                value="طَهُطَا">طَهُطَا</option>
                                <option disabled value>محافظة قنا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قِنَا"):?>
                                     selected
                                <?php endif;?>
                                value="قِنَا">قِنَا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قنا الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="قنا الجديدة">قنا الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبُو تِشْت"):?>
                                     selected
                                <?php endif;?>
                                value="أبُو تِشْت">أبُو تِشْت</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نَجْع حَمَّادِي"):?>
                                     selected
                                <?php endif;?>
                                value="نَجْع حَمَّادِي">نَجْع حَمَّادِي</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نَجْع حَمَّادِي"):?>
                                     selected
                                <?php endif;?>
                                value="نَجْع حَمَّادِي">دِشْنَا</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الوَقْف"):?>
                                     selected
                                <?php endif;?>
                                value="الوَقْف">الوَقْف</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قِفْط"):?>
                                     selected
                                <?php endif;?>
                                value="قِفْط">قِفْط</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نَقَادَة"):?>
                                     selected
                                <?php endif;?>
                                value="نَقَادَة">نَقَادَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="قُوص"):?>
                                     selected
                                <?php endif;?>
                                value="قُوص">قُوص</option>
                                <option 
                                <?php if($adver_paid_row['city']=="فَرْشُوط"):?>
                                     selected
                                <?php endif;?>
                                value="فَرْشُوط">فَرْشُوط</option>
                                <option disabled value>محافظة الأقصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الأقصر"):?>
                                     selected
                                <?php endif;?>  
                                value="الأقصر">الأقصر</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الأقصر الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="الأقصر الجديدة">الأقصر الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="طِيبة الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="طِيبة الجديدة">طِيبة الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الزينيّة"):?>
                                     selected
                                <?php endif;?>
                                value="الزينيّة">الزينيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="البَيَاضِيّة"):?>
                                     selected
                                <?php endif;?>
                                value="البَيَاضِيّة">البَيَاضِيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="القُرْنَة"):?>
                                     selected
                                <?php endif;?>
                                value="القُرْنَة">القُرْنَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أَرمَنْت"):?>
                                     selected
                                <?php endif;?>
                                value="أَرمَنْت">أَرمَنْت</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الطُّود"):?>
                                     selected
                                <?php endif;?>
                                value="الطُّود">الطُّود</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إسنا"):?>
                                     selected
                                <?php endif;?>
                                value="إسنا">إسنا</option>
                                <option disabled value>محافظة أَسْوان</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أَسْوان"):?>
                                     selected
                                <?php endif;?>
                                value="أَسْوان">أَسْوان</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أَسْوان الجديدة"):?>
                                     selected
                                <?php endif;?>
                                value="أَسْوان الجديدة">أَسْوان الجديدة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="دراو"):?>
                                     selected
                                <?php endif;?>
                                value="دراو">دراو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كُوم أُمْبُو"):?>
                                     selected
                                <?php endif;?>
                                value="كُوم أُمْبُو">كُوم أُمْبُو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="نصر النوبة"):?>
                                     selected
                                <?php endif;?>
                                value="نصر النوبة">نصر النوبة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="كَلَابْشَة"):?>
                                     selected
                                <?php endif;?>
                                value="كَلَابْشَة">كَلَابْشَة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="إِدفو"):?>
                                     selected
                                <?php endif;?>
                                value="إِدفو">إِدفو</option>
                                <option 
                                <?php if($adver_paid_row['city']=="الرِّدِيسيّة"):?>
                                     selected
                                <?php endif;?>
                                value="الرِّدِيسيّة">الرِّدِيسيّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="البِصِيليَّة"):?>
                                     selected
                                <?php endif;?>
                                value="البِصِيليَّة">البِصِيليَّة</option>
                                <option 
                                <?php if($adver_paid_row['city']=="السباعية"):?>
                                     selected
                                <?php endif;?>
                                value="السباعية">السباعية</option>
                                <option 
                                <?php if($adver_paid_row['city']=="أبو سمبل السياحية"):?>
                                     selected
                                <?php endif;?>
                                value="أبو سمبل السياحية">أبو سمبل السياحية</option>
                                <option disabled value>أختر المدينة</option>
                            </select>             
                         </div>
                           <p class="error" id="Error_city">خطأ كبير يا نجم</p>



                        <br/>
                        <input type="hidden" name="advertisement_id_get" value="<?php echo $_GET['ad_id'];?>">
                        <input type="submit" value="تعديل الاعلان"  name="login_sub" class="btn_edit_user" />
                                
                </from>
            </div>




        </div>
        <!-- end section body -->
        <div class="clear"></div>
       
        <!-- start section footer -->
        <div class="footer">
            <h4 class="text-center">جميع الحقوق محفوظة 2017 &copy;</h4>
        </div>
        <!-- end section footer -->
       
       <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">
            
            <div class="modal-content mod_con">
                    
              <div class="modal-body mod_body">
                <h4 class="text-center h4"><img 
                    <?php if(@$_SESSION['Success_advertisement_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_advertisement_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    >&nbsp;&nbsp;<?php echo @$_SESSION['message_advertisement'];?></b> </h4>
              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal">إلغاء</h4>
                
              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of logout model -->



        <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message_logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body">
                <h4 class="text-center">
                    <a href="../logout/logout.php">تسجيل الخروج</a>
                    <i class="fa fa-exit"></i>
                </h4> 

              </div>

              <div class="modal-body mod_body cansel">
                <h4 class="text-center h5" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;إلغاء</h4>

              </div>

            </div>
          </div>
        </div>

        <!-- the end of pop up of logout model -->
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/jquery.nicescroll.min.js"></script>
        <script src="../javascript/index.js"></script>
        <script src="../javascript/add_advertisement_paid.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_advertisement_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_advertisement_check']=null;?>
        <!-- end message with error handling -->
        <!-- start logout script-->
        <script type="text/javascript">
        $(document).ready(function(){
            $("#logout").click(function(){
                $('#Message_logout').modal('show');   
            });
             
        });
       </script>
        <!-- end logout script-->
        
    
    </body>
</html>