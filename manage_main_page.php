<?php
    session_start();
    include_once("php_includes/connection_db.php");
    include_once("php_includes/funtions.php");
    check_login("login/login.php","يجب أن تسجل الدخول أولا");
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
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <!-- fontawsome  -->
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <!-- My Css style -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/pop_up.css" />
        <!-- My Media style -->
        <link  rel="stylesheet" href="css/media.css" />
        
        <!-- [if it ie 9] -->
            <script src="javascript/html5shiv.min.js"></script>
            <script src="javascript/respond.min.js"></script>
        <!-- [end if] -->
        
    </head>
    <body>
        <!-- start section header -->
        <div class="header">
            <div class="container">
                <div class="logo">
                    <i class="fa fa-shopping-basket fa-x3"></i>
                    <span>محلاتي</span>
                </div>
                <div class="settings">
                    <a href="#"><i class="fa fa-bell fa-lg"></i></a>
                    <a href="manage_shop_setting/add_shop.php"><i class="fa fa-plus fa-lg"></i></a>
                    <a href="#" id="logout">...</a>
                </div>
            </div>
        </div>
        <!-- end section header -->
        <!-- start section body -->
        <div class="clear"></div>
        <div class="body_content">
            
                <div class="right_list" style="margin-top: -10px; height:700px;">
                    <div class="person_information">
                        <?php 
                        
                            $user_id=$_SESSION['user_id'];
                            $query_name_photo="SELECT `user_name`,`gender`,`photo` FROM `users` WHERE `id`='{$user_id}'";
                            $query_name_photo_perform=mysqli_query($connect,$query_name_photo);
                            $name_photo_row=mysqli_fetch_assoc($query_name_photo_perform); 
                            $user_name=$name_photo_row['user_name'];
                            $user_gender=$name_photo_row['gender'];
                            $user_photo=$name_photo_row['photo'];
                            
                            if($user_photo==null)
                            {
                                //default photo
                                if($user_gender=="male")
                                {
                                    echo "<img src=\"images/default_images/default-person.jpg\" title=\"عبدالله حسن\" />";            
                                }else if($user_gender=="female")
                                {
                                    echo "<img src=\"images/default_images/user_profile_female.jpg\" title=\"عبدالله حسن\" />";
                                }
                            }else
                            {
                                //link to custimized image
                                 echo "<img src=\"images/users/{$user_id}/{$user_photo}\" title=\"عبدالله حسن\" />";
                            }
                            
                            echo "<h4 class=\"text-center\">{$user_name}</h4>";
                        ?>
                    </div>
                    <hr/>
                    <div class="panel_links">
                        <ul class="list-unstyled ">
                            <li><a href="index.php"><i class="fa fa-bell "></i> <span>لوحة تحكم محلاتي</span></a></li>
                            <li><a href="manage_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين</span></a></li>
                            <li><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li class="active"><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
                            <li><a href="manage_advertisement.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الرئيسية</span></a></li>
                            <li><a href="manage_advertisement_paid.php"><i class="fa fa-bell "></i> <span>إدارة الأعلانات الممولة</span></a></li>
                            <li><a href="manage_contact_us.php"><i class="fa fa-bell "></i> <span>إدارة التواصل</span></a></li>
                            <li><a href="manage_places.php"><i class="fa fa-bell "></i> <span>إدارة الأماكن</span></a></li>
                            <li><a href="manage_services.php"><i class="fa fa-bell "></i> <span>إدارة الخدمات</span></a></li>
                            <li><a href="manage_orders.php"><i class="fa fa-bell "></i> <span>إدارة الطلبات</span></a></li>
                            <li><a href="manage_normal_users.php"><i class="fa fa-bell "></i> <span>إدارة المستخدمين العاديين</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                </div>


                <div class="header_panel2">
                  
                  <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة الصفحة الرئيسية App</span> </h4>
                    
                     
                  <ul class="list-unstyled main_links">
                     <li id="link_one_offers" class="active"><a>إدارة العروض علي الصفحة الرئيسية</a></li>
                     <li id="link_two_shops"><a>إدارة المحلات علي الصفحة الرئيسية</a></li>
                  </ul>    

                </div>
                

                <div class="left_content" id="offers_main">
                    
                       
                    
                    <br/><br/>
                    <div class="box">
                         
                         <div class="filter_main">
                             <input type="text" id="search_offer" name="search_offer" placeholder="أبحث باسم العرض ...">
                         </div>
                         <div class="main_city_filter">
                           <!-- city type-->
                          <div class="kind">
                              <select id="select_city_offer" name="filter_city" >
                                  <option selected disabled value>أختر المدينة</option>
                                  <option selected disabled value>محافظة القاهرة</option>
                                  <option value="حي الزيتون">حي الزيتون</option>
                                  <option value="حي الزاوية الحمراء">حي الزاوية الحمراء</option>
                                  <option value="حي حدائق القبة">حي حدائق القبة</option>
                                  <option value="حي الشرابية">حي الشرابية</option>
                                  <option value="حي الساحل">حي الساحل</option>
                                  <option value="حي شبرا">حي شبرا</option>
                                  <option value="حي روض الفرج">حي روض الفرج</option>
                                  <option value="حي الأميرية">حي الأميرية</option>
                                  <option value="حي السلام أول">حي السلام أول</option>
                                  <option value="حي السلام ثان">حي السلام ثان</option>
                                  <option value="حي المرج">حي المرج</option>
                                  <option value="حي المطرية">حي المطرية</option>
                                  <option value="حي عين شمس">حي عين شمس</option>
                                  <option value="حي النزهة">حي النزهة</option>
                                  <option value="حي مصر الجديدة">حي مصر الجديدة</option>
                                  <option value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                  <option value="حي غرب مدينة نصر">حي غرب مدينة نصر</option>
                                  <option value="حي الوايلي">حي الوايلي</option>
                                  <option value="حي منشأة ناصر">حي منشأة ناصر</option>
                                  <option value="حي وسط">حي وسط</option>
                                  <option value="حي باب الشعرية">حي باب الشعرية</option>
                                  <option value="حي الأزبكية">حي الأزبكية</option>
                                  <option value="حي بولاق">حي بولاق</option>
                                  <option value="حي الموسكي">حي الموسكي</option>
                                  <option value="حي عابدين">حي عابدين</option>
                                  <option value="حي غرب">حي غرب</option>
                                  <option value="حي المقطم">حي المقطم</option>
                                  <option value="حي الخليفة">حي الخليفة</option>
                                  <option value="حي السيدة زينب">حي السيدة زينب</option>
                                  <option value="حي مصر القديمة">حي مصر القديمة</option>
                                  <option value="حي دار السلام">حي دار السلام</option>
                                  <option value="حي البساتين">حي البساتين</option>
                                  <option value="حي المعادي">حي المعادي</option>
                                  <option value="حي طره">حي طره</option>
                                  <option value="حي المعصرة">حي المعصرة</option>
                                  <option value="حي 15 مايو">حي 15 مايو</option>
                                  <option value="حي حلوان">حي حلوان</option>
                                  <option value="حي التبين">حي التبين</option>
                                  <option value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                  <option value="القاهرة الجديدة">القاهرة الجديدة</option>
                                  <option value="بدر">بدر</option>
                                  <option value="الشروق">الشروق</option>
                                  <option selected disabled value>محافظة الجِيزَة</option>
                                  <option value="الجِيزَة">الجِيزَة</option>
                                  <option value="السادس من أكتوبر">السادس من أكتوبر</option>
                                  <option value="الشيخ زايد">الشيخ زايد</option>
                                  <option value="الحَوامْدِيّة">الحَوامْدِيّة</option>
                                  <option value="البَدْرْشِين">البَدْرْشِين</option>
                                  <option value="الصَّف">الصَّف</option>
                                  <option value="أطْفِيح">أطْفِيح</option>
                                  <option value="العَيَّاط">العَيَّاط</option>
                                  <option value="الباويطي">الباويطي</option>
                                  <option value="منشأة القناطر">منشأة القناطر</option>
                                  <option value="أَوْسِيم">أَوْسِيم</option>
                                  <option value="كِرْداسَة">كِرْداسَة</option>
                                  <option value="أبو النُمْرُس">أبو النُمْرُس</option>
                                  <option value="كفر غطاطي ومنشأة البكاري">كفر غطاطي ومنشأة البكاري</option>
                                  <option selected disabled value>محافظة القليوبية</option>
                                  <option value="بَنْها">بَنْها</option>
                                  <option value="قَلْيوب">قَلْيوب</option>
                                  <option value="شُبْرا الخيمة">شُبْرا الخيمة</option>
                                  <option value="القناطر الخيرية">القناطر الخيرية</option>
                                  <option value="الخْانْكَة">الخْانْكَة</option>
                                  <option value="كفر شُكر">كفر شُكر</option>
                                  <option value="طُوخ">طُوخ</option>
                                  <option value="قَها">قَها</option>
                                  <option value="العبور">العبور</option>
                                  <option value="الخُصُوص">الخُصُوص</option>
                                  <option value="شِبِين القناطر">شِبِين القناطر</option>
                                  <option selected disabled value>محافظة الإسكندرية</option>
                                  <option value="الإسكندرية">الإسكندرية</option>
                                  <option value="برج العرب">برج العرب</option>
                                  <option value="برج العرب الجديدة">برج العرب الجديدة</option>
                                  <option selected disabled value>محافظة البحيرة</option>
                                  <option value="دَمَنْهور">دَمَنْهور</option>
                                  <option value="كفر الدَّوَّار">كفر الدَّوَّار</option>
                                  <option value="رَشيد">رَشيد</option>
                                  <option value="إدكو">إدكو</option>
                                  <option value="أبو المطامير">أبو المطامير</option>
                                  <option value="أبو حُمُّص">أبو حُمُّص</option>
                                  <option value="الدِّلنْجات">الدِّلنْجات</option>
                                  <option value="المحموديّة">المحموديّة</option>
                                  <option value="الرحمانيّة">الرحمانيّة</option>
                                  <option value="إيتاي البارود">إيتاي البارود</option>
                                  <option value="حُوش عيسى">حُوش عيسى</option>
                                  <option value="شُبراخِيت">شُبراخِيت</option>
                                  <option value="كوم حمادة">كوم حمادة</option>
                                  <option value="بدر">بدر</option>
                                  <option value="وادي النَطْرون">وادي النَطْرون</option>
                                  <option value="النُوبَاريّة الجديدة">النُوبَاريّة الجديدة</option>
                                  <option selected disabled value>محافظة مطروح</option>
                                  <option value="مَرْسَى مَطْرُوح">مَرْسَى مَطْرُوح</option>
                                  <option value="الحَمَّام">الحَمَّام</option>
                                  <option value="العَلَمِين">العَلَمِين</option>
                                  <option value="الضَّبْعَة">الضَّبْعَة</option>
                                  <option value="النِّجِيلَة">النِّجِيلَة</option>
                                  <option value="سِيِدي بَرَّانِي">سِيِدي بَرَّانِي</option>
                                  <option value="السَّلُّوم">السَّلُّوم</option>
                                  <option value="سِيوَة">سِيوَة</option>
                                  <option selected disabled value>محافظة دمياط</option>
                                  <option value="دمياط">دمياط</option>
                                  <option value="دمياط الجديدة">دمياط الجديدة</option>
                                  <option value="رأس البر">رأس البر</option>
                                  <option value="فارسكور">فارسكور</option>
                                  <option value="كفر سعد">كفر سعد</option>
                                  <option value="الزرقا">الزرقا</option>
                                  <option value="السرو">السرو</option>
                                  <option value="الروضة">الروضة</option>
                                  <option value="كفر البطيخ">كفر البطيخ</option>
                                  <option value="عزبة البرج">عزبة البرج</option>
                                  <option value="ميت أبو غالب">ميت أبو غالب</option>
                                  <option selected disabled value>محافظة الدقهلية</option>
                                  <option value="المنصورة">المنصورة</option>
                                  <option value="طَلْخا">طَلْخا</option>
                                  <option value="ميت غمر">ميت غمر</option>
                                  <option value="دِكِرِنْس">دِكِرِنْس</option>
                                  <option value="أجا">أجا</option>
                                  <option value="منية النصر">منية النصر</option>
                                  <option value="السنبلاوين">السنبلاوين</option>
                                  <option value="الكردي">الكردي</option>
                                  <option value="بني عبيد">بني عبيد</option>
                                  <option value="المنزلة">المنزلة</option>
                                  <option value="تمي الأمديد">تمي الأمديد</option>
                                  <option value="الجمالية">الجمالية</option>
                                  <option value="شربين">شربين</option>
                                  <option value="المطرية">المطرية</option>
                                  <option value="بلقاس">بلقاس</option>
                                  <option value="ميت سلسيل">ميت سلسيل</option>
                                  <option value="جمصة">جمصة</option>
                                  <option value="محلة دمنة">محلة دمنة</option>
                                  <option value="نبروه">نبروه</option>
                                  <option selected disabled value>محافظة كفر الشيخ</option>
                                  <option value="كفر الشيخ">كفر الشيخ</option>
                                  <option value="دِسوق">دِسوق</option>
                                  <option value="فُوّه">فُوّه</option>
                                  <option value="مِطوُبِس">مِطوُبِس</option>
                                  <option value="بَلْطيم">بَلْطيم</option>
                                  <option value="مصيف بَلْطيم">مصيف بَلْطيم</option>
                                  <option value="الحامول">الحامول</option>
                                  <option value="بِيَلا">بِيَلا</option>
                                  <option value="الرياض">الرياض</option>
                                  <option value="سيدي سالم">سيدي سالم</option>
                                  <option value="قَلّين">قَلّين</option>
                                  <option value="سيدي غازي">سيدي غازي</option>
                                  <option value="بُرج البُرلُّس">بُرج البُرلُّس</option>
                                  <option selected disabled value>محافظة الغربية</option>
                                  <option value="طنْطَا">طنْطَا</option>
                                  <option value="المحلة الكبرى">المحلة الكبرى</option>
                                  <option value="كفر الزَّيَّات">كفر الزَّيَّات</option>
                                  <option value="زِفْتى">زِفْتى</option>
                                  <option value="السّنْطة">السّنْطة</option>
                                  <option value="قُطور">قُطور</option>
                                  <option value="بَسْيون">بَسْيون</option>
                                  <option value="سَمَنُّود">سَمَنُّود</option>
                                  <option selected disabled value>محافظة المنوفية</option>
                                  <option value="شِبين الكوم">شِبين الكوم</option>
                                  <option value="مدينة السادات">مدينة السادات</option>
                                  <option value="مِنُوف">مِنُوف</option>
                                  <option value="سِرس الليَّان">سِرس الليَّان</option>
                                  <option value="أَشْمُون">أَشْمُون</option>
                                  <option value="الباجور">الباجور</option>
                                  <option value="ُوِيْسنا">ُوِيْسنا</option>
                                  <option value="بركة السبع">بركة السبع</option>
                                  <option value="تَلَا">تَلَا</option>
                                  <option value="الشهداء">الشهداء</option>
                                  <option selected disabled value>محافظة الشرقية</option>
                                  <option value="الزقازيق">الزقازيق</option>
                                  <option value="العاشر من رمضان">العاشر من رمضان</option>
                                  <option value="منيا القمح">منيا القمح</option>
                                  <option value="بِلْبيس">بِلْبيس</option>
                                  <option value="مشتول السوق">مشتول السوق</option>
                                  <option value="القنايات">القنايات</option>
                                  <option value="أبو حمّاد">أبو حمّاد</option>
                                  <option value="القُرين">القُرين</option>
                                  <option value="هِهْيا">هِهْيا</option>
                                  <option value="أبو كبير">أبو كبير</option>
                                  <option value="فاقوس">فاقوس</option>
                                  <option value="الصالحية الجديدة">الصالحية الجديدة</option>
                                  <option value="الإبراهيمية">الإبراهيمية</option>
                                  <option value="ديرب نجم">ديرب نجم</option>
                                  <option value="كفر صقر">كفر صقر</option>
                                  <option value="أولاد صقر">أولاد صقر</option>
                                  <option value="الحسينية">الحسينية</option>
                                  <option value="صان الحجر القبلية">صان الحجر القبلية</option>
                                  <option value="منشأة أبو عمر">منشأة أبو عمر</option>
                                  <option selected disabled value>محافظة بورسعيد</option>
                                  <option value="بورسعيد">بورسعيد</option>
                                  <option value="بورفؤاد">بورفؤاد</option>
                                  <option selected disabled value>محافظة الإسماعيلية</option>
                                  <option value="الإسماعيلية">الإسماعيلية</option>
                                  <option value="فايد">فايد</option>
                                  <option value="القنطرة شرق">القنطرة شرق</option>
                                  <option value="القنطرة غرب">القنطرة غرب</option>
                                  <option value="التل الكبير">التل الكبير</option>
                                  <option value="أبو صوير المحطة">أبو صوير المحطة</option>
                                  <option value="القصاصين الجديدة">القصاصين الجديدة</option>
                                  <option selected disabled value>محافظة السويس</option>
                                  <option value="السويس">السويس</option>
                                  <option selected disabled value>محافظة شمال سيناء</option>
                                  <option value="العريش">العريش</option>
                                  <option value="الشّيخ زُوَيِّد">الشّيخ زُوَيِّد</option>
                                  <option value="رَفَح">رَفَح</option>
                                  <option value="بئر العبد">بئر العبد</option>
                                  <option value="الحَسَنَة">الحَسَنَة</option>
                                  <option value="نَخِل">نَخِل</option>
                                  <option selected disabled value>محافظة جنوب سيناء</option>
                                  <option value="الطور">الطور</option>
                                  <option value="شرم الشيخ">شرم الشيخ</option>
                                  <option value="دهب">دهب</option>
                                  <option value="نويبع">نويبع</option>
                                  <option value="طابا">طابا</option>
                                  <option value="سانت كاترين">سانت كاترين</option>
                                  <option value="أبو رديس">أبو رديس</option>
                                  <option value="أبو زنيمة">أبو زنيمة</option>
                                  <option value="رأس سدر">رأس سدر</option>
                                  <option selected disabled value>محافظة بني سويف</option>
                                  <option value="بني سويف">بني سويف</option>
                                  <option value="بني سويف الجديدة">بني سويف الجديدة</option>
                                  <option value="الواسْطَى">الواسْطَى</option>
                                  <option value="ناصر">ناصر</option>
                                  <option value="إهناسيا">إهناسيا</option>
                                  <option value="بِبا">بِبا</option>
                                  <option value="سمسطا">سمسطا</option>
                                  <option value="الفَشْن">الفَشْن</option>
                                  <option selected disabled value>محافظة الفيوم</option>
                                  <option value="الفُيُّوم">الفُيُّوم</option>
                                  <option value="الفُيُّوم الجديدة">الفُيُّوم الجديدة</option>
                                  <option value="طَامِيِّة">طَامِيِّة</option>
                                  <option value="سنورس">سنورس</option>
                                  <option value="إطسا">إطسا</option>
                                  <option value="إبشواي">إبشواي</option>
                                  <option value="يوسف الصديق">يوسف الصديق</option>
                                  <option selected disabled value>محافظة المنيا</option>
                                  <option value="المنيا">المنيا</option>
                                  <option value="المنيا الجديدة">المنيا الجديدة</option>
                                  <option value="العدوة">العدوة</option>
                                  <option value="مَغَاغَة">مَغَاغَة</option>
                                  <option value="بني مزار">بني مزار</option>
                                  <option value="مَطَاي">مَطَاي</option>
                                  <option value="سَمَالُوط">سَمَالُوط</option>
                                  <option value="المدينة الفكرية">المدينة الفكرية</option>
                                  <option value="مَلّوي">مَلّوي</option>
                                  <option value="دِير مَوَاس">دِير مَوَاس</option>
                                  <option selected disabled value>محافظة أسيوط</option>
                                  <option value="الخَارْجَة">الخَارْجَة</option>
                                  <option value="باريس">باريس</option>
                                  <option value="مُوط">مُوط</option>
                                  <option value="الفرافرة">الفرافرة</option>
                                  <option value="بلاط">بلاط</option>
                                  <option selected disabled value>محافظة البحر الأحمر</option>
                                  <option value="الغردقة">الغردقة</option>
                                  <option value="رأس غارب">رأس غارب</option>
                                  <option value="سفاجا">سفاجا</option>
                                  <option value="القصير">القصير</option>
                                  <option value="مرسى علم">مرسى علم</option>
                                  <option value="الشلاتين">الشلاتين</option>
                                  <option value="حلايب">حلايب</option>
                                  <option selected disabled value>محافظة سوهاج</option>
                                  <option value="سُوهَاج">سُوهَاج</option>
                                  <option value="سوهاج الجديدة">سوهاج الجديدة</option>
                                  <option value="أخميم">أخميم</option>
                                  <option value="أخميم الجديدة">أخميم الجديدة</option>
                                  <option value="البلْيَنا">البلْيَنا</option>
                                  <option value="المراغة">المراغة</option>
                                  <option value="المنشأة">المنشأة</option>
                                  <option value="دار السلام">دار السلام</option>
                                  <option value="جِرجا">جِرجا</option>
                                  <option value="جُهِينَة الغربيّة">جُهِينَة الغربيّة</option>
                                  <option value="ساقلته">ساقلته</option>
                                  <option value="طمَا">طمَا</option>
                                  <option value="طَهُطَا">طَهُطَا</option>
                                  <option selected disabled value>محافظة قنا</option>
                                  <option value="قِنَا">قِنَا</option>
                                  <option value="قنا الجديدة">قنا الجديدة</option>
                                  <option value="أبُو تِشْت">أبُو تِشْت</option>
                                  <option value="نَجْع حَمَّادِي">نَجْع حَمَّادِي</option>
                                  <option value="دِشْنَا">دِشْنَا</option>
                                  <option value="الوَقْف">الوَقْف</option>
                                  <option value="قِفْط">قِفْط</option>
                                  <option value="نَقَادَة">نَقَادَة</option>
                                  <option value="قُوص">قُوص</option>
                                  <option value="فَرْشُوط">فَرْشُوط</option>
                                  <option selected disabled value>محافظة الأقصر</option>
                                  <option value="الأقصر">الأقصر</option>
                                  <option value="الأقصر الجديدة">الأقصر الجديدة</option>
                                  <option value="طِيبة الجديدة">طِيبة الجديدة</option>
                                  <option value="الزينيّة">الزينيّة</option>
                                  <option value="البَيَاضِيّة">البَيَاضِيّة</option>
                                  <option value="القُرْنَة">القُرْنَة</option>
                                  <option value="أَرمَنْت">أَرمَنْت</option>
                                  <option value="الطُّود">الطُّود</option>
                                  <option value="إسنا">إسنا</option>
                                  <option selected disabled value>محافظة أَسْوان</option>
                                  <option value="أَسْوان">أَسْوان</option>
                                  <option value="أَسْوان الجديدة">أَسْوان الجديدة</option>
                                  <option value="دراو">دراو</option>
                                  <option value="كُوم أُمْبُو">كُوم أُمْبُو</option>
                                  <option value="نصر النوبة">نصر النوبة</option>
                                  <option value="كَلَابْشَة">كَلَابْشَة</option>
                                  <option value="إِدفو">إِدفو</option>
                                  <option value="الرِّدِيسيّة">الرِّدِيسيّة</option>
                                  <option value="البِصِيليَّة">البِصِيليَّة</option>
                                  <option value="السباعية">السباعية</option>
                                  <option value="أبو سمبل السياحية">أبو سمبل السياحية</option>
                                  <option selected disabled value>أختر المدينة</option>
                              </select>             
                           </div>

                         </div> 
                         <div class="main_city_filter">
                           <!-- city type-->
                          <div class="kind">
                              <select id="select_main_page_offer" name="filter_city" >
                                  <option selected disabled value>العرض علي الصفحه الرئيسيه</option>
                                  <option value="1">الصفحة الرئيسيه</option>
                                  <option value="0">عرض عادي</option>
                                  <option value="2">الكل</option>
                                  
                              </select>             
                           </div>

                         </div>  
                     </div>   


                     <br/>
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl"  id="offer_data">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>تاريخ بداية العرض</td>
                                <td>تاريخ نهاية العرض</td>
                                <td>عرض علي الصفحة الرئيسية</td>
                                <td>أسم العرض</td>
                                <td>صورة العرض</td>
                                <td>وصف العرض</td>
                              </tr>
                          </tbody>

                          <?php
                          	$query_get_offers="SELECT `offers`.`id`, `offer_name`, `offer_description`, `offer_photo`,`user_id`,`shop_id`, `offers`.`main_page`, `from_date`, `to_date` FROM `offers` INNER JOIN `shop` ON `offers`.`shop_id`=`shop`.`id`";
                          	$perform_query_get_offers=mysqli_query($connect,$query_get_offers);
                          	while($row_result=mysqli_fetch_assoc($perform_query_get_offers))
                          	{
                          		echo "<tr>";
                                echo "<td>".$row_result['id']."</td>";
                                echo "<td>".$row_result['from_date']."</td>";
                                echo "<td>".$row_result['to_date']."</td>";
                                if($row_result['main_page']=="1")
                                {
                                	echo "<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\"".$row_result['id']."\" class=\"offer_no\"/></td>";	
                                }else
                                {
                                	echo "<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\"".$row_result['id']."\" class=\"offer_no\"/></td>";
                                }
                                echo "<td>".$row_result['offer_name']."</td>";
                                echo "<td><img src=\"images/users/".$row_result['user_id']."/".$row_result['shop_id']."/offers/".$row_result['id']."/".$row_result['offer_photo']."\" style=\"width:50px;height:50px;\"title=\"pic\"/></td>"; 
                                echo "<td>".$row_result['offer_description']."</td>";


                          		echo "</tr>";
                          	}
                          ?>
                    
                      </table>

                      
                    



                </div>
            <!----------------------------------------------------------------------------------------------------------------->
            <div class="left_content" id="shops_main">
                    
                       
                    
                    <br/><br/>
                    <div class="box">
                         
                         <div class="filter_main">
                             <input type="text" id="search_shop" name="search_shop" placeholder="أبحث باسم المحل ...">
                         </div>
                         <div class="main_city_filter">
                           <!-- city type-->
                          <div class="kind">
                              <select id="select_city_shop" name="filter_city" >
                                  <option selected disabled value>أختر المدينة</option>
                                  <option selected disabled value>محافظة القاهرة</option>
                                  <option value="حي الزيتون">حي الزيتون</option>
                                  <option value="حي الزاوية الحمراء">حي الزاوية الحمراء</option>
                                  <option value="حي حدائق القبة">حي حدائق القبة</option>
                                  <option value="حي الشرابية">حي الشرابية</option>
                                  <option value="حي الساحل">حي الساحل</option>
                                  <option value="حي شبرا">حي شبرا</option>
                                  <option value="حي روض الفرج">حي روض الفرج</option>
                                  <option value="حي الأميرية">حي الأميرية</option>
                                  <option value="حي السلام أول">حي السلام أول</option>
                                  <option value="حي السلام ثان">حي السلام ثان</option>
                                  <option value="حي المرج">حي المرج</option>
                                  <option value="حي المطرية">حي المطرية</option>
                                  <option value="حي عين شمس">حي عين شمس</option>
                                  <option value="حي النزهة">حي النزهة</option>
                                  <option value="حي مصر الجديدة">حي مصر الجديدة</option>
                                  <option value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                  <option value="حي غرب مدينة نصر">حي غرب مدينة نصر</option>
                                  <option value="حي الوايلي">حي الوايلي</option>
                                  <option value="حي منشأة ناصر">حي منشأة ناصر</option>
                                  <option value="حي وسط">حي وسط</option>
                                  <option value="حي باب الشعرية">حي باب الشعرية</option>
                                  <option value="حي الأزبكية">حي الأزبكية</option>
                                  <option value="حي بولاق">حي بولاق</option>
                                  <option value="حي الموسكي">حي الموسكي</option>
                                  <option value="حي عابدين">حي عابدين</option>
                                  <option value="حي غرب">حي غرب</option>
                                  <option value="حي المقطم">حي المقطم</option>
                                  <option value="حي الخليفة">حي الخليفة</option>
                                  <option value="حي السيدة زينب">حي السيدة زينب</option>
                                  <option value="حي مصر القديمة">حي مصر القديمة</option>
                                  <option value="حي دار السلام">حي دار السلام</option>
                                  <option value="حي البساتين">حي البساتين</option>
                                  <option value="حي المعادي">حي المعادي</option>
                                  <option value="حي طره">حي طره</option>
                                  <option value="حي المعصرة">حي المعصرة</option>
                                  <option value="حي 15 مايو">حي 15 مايو</option>
                                  <option value="حي حلوان">حي حلوان</option>
                                  <option value="حي التبين">حي التبين</option>
                                  <option value="حي شرق مدينة نصر">حي شرق مدينة نصر</option>
                                  <option value="القاهرة الجديدة">القاهرة الجديدة</option>
                                  <option value="بدر">بدر</option>
                                  <option value="الشروق">الشروق</option>
                                  <option selected disabled value>محافظة الجِيزَة</option>
                                  <option value="الجِيزَة">الجِيزَة</option>
                                  <option value="السادس من أكتوبر">السادس من أكتوبر</option>
                                  <option value="الشيخ زايد">الشيخ زايد</option>
                                  <option value="الحَوامْدِيّة">الحَوامْدِيّة</option>
                                  <option value="البَدْرْشِين">البَدْرْشِين</option>
                                  <option value="الصَّف">الصَّف</option>
                                  <option value="أطْفِيح">أطْفِيح</option>
                                  <option value="العَيَّاط">العَيَّاط</option>
                                  <option value="الباويطي">الباويطي</option>
                                  <option value="منشأة القناطر">منشأة القناطر</option>
                                  <option value="أَوْسِيم">أَوْسِيم</option>
                                  <option value="كِرْداسَة">كِرْداسَة</option>
                                  <option value="أبو النُمْرُس">أبو النُمْرُس</option>
                                  <option value="كفر غطاطي ومنشأة البكاري">كفر غطاطي ومنشأة البكاري</option>
                                  <option selected disabled value>محافظة القليوبية</option>
                                  <option value="بَنْها">بَنْها</option>
                                  <option value="قَلْيوب">قَلْيوب</option>
                                  <option value="شُبْرا الخيمة">شُبْرا الخيمة</option>
                                  <option value="القناطر الخيرية">القناطر الخيرية</option>
                                  <option value="الخْانْكَة">الخْانْكَة</option>
                                  <option value="كفر شُكر">كفر شُكر</option>
                                  <option value="طُوخ">طُوخ</option>
                                  <option value="قَها">قَها</option>
                                  <option value="العبور">العبور</option>
                                  <option value="الخُصُوص">الخُصُوص</option>
                                  <option value="شِبِين القناطر">شِبِين القناطر</option>
                                  <option selected disabled value>محافظة الإسكندرية</option>
                                  <option value="الإسكندرية">الإسكندرية</option>
                                  <option value="برج العرب">برج العرب</option>
                                  <option value="برج العرب الجديدة">برج العرب الجديدة</option>
                                  <option selected disabled value>محافظة البحيرة</option>
                                  <option value="دَمَنْهور">دَمَنْهور</option>
                                  <option value="كفر الدَّوَّار">كفر الدَّوَّار</option>
                                  <option value="رَشيد">رَشيد</option>
                                  <option value="إدكو">إدكو</option>
                                  <option value="أبو المطامير">أبو المطامير</option>
                                  <option value="أبو حُمُّص">أبو حُمُّص</option>
                                  <option value="الدِّلنْجات">الدِّلنْجات</option>
                                  <option value="المحموديّة">المحموديّة</option>
                                  <option value="الرحمانيّة">الرحمانيّة</option>
                                  <option value="إيتاي البارود">إيتاي البارود</option>
                                  <option value="حُوش عيسى">حُوش عيسى</option>
                                  <option value="شُبراخِيت">شُبراخِيت</option>
                                  <option value="كوم حمادة">كوم حمادة</option>
                                  <option value="بدر">بدر</option>
                                  <option value="وادي النَطْرون">وادي النَطْرون</option>
                                  <option value="النُوبَاريّة الجديدة">النُوبَاريّة الجديدة</option>
                                  <option selected disabled value>محافظة مطروح</option>
                                  <option value="مَرْسَى مَطْرُوح">مَرْسَى مَطْرُوح</option>
                                  <option value="الحَمَّام">الحَمَّام</option>
                                  <option value="العَلَمِين">العَلَمِين</option>
                                  <option value="الضَّبْعَة">الضَّبْعَة</option>
                                  <option value="النِّجِيلَة">النِّجِيلَة</option>
                                  <option value="سِيِدي بَرَّانِي">سِيِدي بَرَّانِي</option>
                                  <option value="السَّلُّوم">السَّلُّوم</option>
                                  <option value="سِيوَة">سِيوَة</option>
                                  <option selected disabled value>محافظة دمياط</option>
                                  <option value="دمياط">دمياط</option>
                                  <option value="دمياط الجديدة">دمياط الجديدة</option>
                                  <option value="رأس البر">رأس البر</option>
                                  <option value="فارسكور">فارسكور</option>
                                  <option value="كفر سعد">كفر سعد</option>
                                  <option value="الزرقا">الزرقا</option>
                                  <option value="السرو">السرو</option>
                                  <option value="الروضة">الروضة</option>
                                  <option value="كفر البطيخ">كفر البطيخ</option>
                                  <option value="عزبة البرج">عزبة البرج</option>
                                  <option value="ميت أبو غالب">ميت أبو غالب</option>
                                  <option selected disabled value>محافظة الدقهلية</option>
                                  <option value="المنصورة">المنصورة</option>
                                  <option value="طَلْخا">طَلْخا</option>
                                  <option value="ميت غمر">ميت غمر</option>
                                  <option value="دِكِرِنْس">دِكِرِنْس</option>
                                  <option value="أجا">أجا</option>
                                  <option value="منية النصر">منية النصر</option>
                                  <option value="السنبلاوين">السنبلاوين</option>
                                  <option value="الكردي">الكردي</option>
                                  <option value="بني عبيد">بني عبيد</option>
                                  <option value="المنزلة">المنزلة</option>
                                  <option value="تمي الأمديد">تمي الأمديد</option>
                                  <option value="الجمالية">الجمالية</option>
                                  <option value="شربين">شربين</option>
                                  <option value="المطرية">المطرية</option>
                                  <option value="بلقاس">بلقاس</option>
                                  <option value="ميت سلسيل">ميت سلسيل</option>
                                  <option value="جمصة">جمصة</option>
                                  <option value="محلة دمنة">محلة دمنة</option>
                                  <option value="نبروه">نبروه</option>
                                  <option selected disabled value>محافظة كفر الشيخ</option>
                                  <option value="كفر الشيخ">كفر الشيخ</option>
                                  <option value="دِسوق">دِسوق</option>
                                  <option value="فُوّه">فُوّه</option>
                                  <option value="مِطوُبِس">مِطوُبِس</option>
                                  <option value="بَلْطيم">بَلْطيم</option>
                                  <option value="مصيف بَلْطيم">مصيف بَلْطيم</option>
                                  <option value="الحامول">الحامول</option>
                                  <option value="بِيَلا">بِيَلا</option>
                                  <option value="الرياض">الرياض</option>
                                  <option value="سيدي سالم">سيدي سالم</option>
                                  <option value="قَلّين">قَلّين</option>
                                  <option value="سيدي غازي">سيدي غازي</option>
                                  <option value="بُرج البُرلُّس">بُرج البُرلُّس</option>
                                  <option selected disabled value>محافظة الغربية</option>
                                  <option value="طنْطَا">طنْطَا</option>
                                  <option value="المحلة الكبرى">المحلة الكبرى</option>
                                  <option value="كفر الزَّيَّات">كفر الزَّيَّات</option>
                                  <option value="زِفْتى">زِفْتى</option>
                                  <option value="السّنْطة">السّنْطة</option>
                                  <option value="قُطور">قُطور</option>
                                  <option value="بَسْيون">بَسْيون</option>
                                  <option value="سَمَنُّود">سَمَنُّود</option>
                                  <option selected disabled value>محافظة المنوفية</option>
                                  <option value="شِبين الكوم">شِبين الكوم</option>
                                  <option value="مدينة السادات">مدينة السادات</option>
                                  <option value="مِنُوف">مِنُوف</option>
                                  <option value="سِرس الليَّان">سِرس الليَّان</option>
                                  <option value="أَشْمُون">أَشْمُون</option>
                                  <option value="الباجور">الباجور</option>
                                  <option value="ُوِيْسنا">ُوِيْسنا</option>
                                  <option value="بركة السبع">بركة السبع</option>
                                  <option value="تَلَا">تَلَا</option>
                                  <option value="الشهداء">الشهداء</option>
                                  <option selected disabled value>محافظة الشرقية</option>
                                  <option value="الزقازيق">الزقازيق</option>
                                  <option value="العاشر من رمضان">العاشر من رمضان</option>
                                  <option value="منيا القمح">منيا القمح</option>
                                  <option value="بِلْبيس">بِلْبيس</option>
                                  <option value="مشتول السوق">مشتول السوق</option>
                                  <option value="القنايات">القنايات</option>
                                  <option value="أبو حمّاد">أبو حمّاد</option>
                                  <option value="القُرين">القُرين</option>
                                  <option value="هِهْيا">هِهْيا</option>
                                  <option value="أبو كبير">أبو كبير</option>
                                  <option value="فاقوس">فاقوس</option>
                                  <option value="الصالحية الجديدة">الصالحية الجديدة</option>
                                  <option value="الإبراهيمية">الإبراهيمية</option>
                                  <option value="ديرب نجم">ديرب نجم</option>
                                  <option value="كفر صقر">كفر صقر</option>
                                  <option value="أولاد صقر">أولاد صقر</option>
                                  <option value="الحسينية">الحسينية</option>
                                  <option value="صان الحجر القبلية">صان الحجر القبلية</option>
                                  <option value="منشأة أبو عمر">منشأة أبو عمر</option>
                                  <option selected disabled value>محافظة بورسعيد</option>
                                  <option value="بورسعيد">بورسعيد</option>
                                  <option value="بورفؤاد">بورفؤاد</option>
                                  <option selected disabled value>محافظة الإسماعيلية</option>
                                  <option value="الإسماعيلية">الإسماعيلية</option>
                                  <option value="فايد">فايد</option>
                                  <option value="القنطرة شرق">القنطرة شرق</option>
                                  <option value="القنطرة غرب">القنطرة غرب</option>
                                  <option value="التل الكبير">التل الكبير</option>
                                  <option value="أبو صوير المحطة">أبو صوير المحطة</option>
                                  <option value="القصاصين الجديدة">القصاصين الجديدة</option>
                                  <option selected disabled value>محافظة السويس</option>
                                  <option value="السويس">السويس</option>
                                  <option selected disabled value>محافظة شمال سيناء</option>
                                  <option value="العريش">العريش</option>
                                  <option value="الشّيخ زُوَيِّد">الشّيخ زُوَيِّد</option>
                                  <option value="رَفَح">رَفَح</option>
                                  <option value="بئر العبد">بئر العبد</option>
                                  <option value="الحَسَنَة">الحَسَنَة</option>
                                  <option value="نَخِل">نَخِل</option>
                                  <option selected disabled value>محافظة جنوب سيناء</option>
                                  <option value="الطور">الطور</option>
                                  <option value="شرم الشيخ">شرم الشيخ</option>
                                  <option value="دهب">دهب</option>
                                  <option value="نويبع">نويبع</option>
                                  <option value="طابا">طابا</option>
                                  <option value="سانت كاترين">سانت كاترين</option>
                                  <option value="أبو رديس">أبو رديس</option>
                                  <option value="أبو زنيمة">أبو زنيمة</option>
                                  <option value="رأس سدر">رأس سدر</option>
                                  <option selected disabled value>محافظة بني سويف</option>
                                  <option value="بني سويف">بني سويف</option>
                                  <option value="بني سويف الجديدة">بني سويف الجديدة</option>
                                  <option value="الواسْطَى">الواسْطَى</option>
                                  <option value="ناصر">ناصر</option>
                                  <option value="إهناسيا">إهناسيا</option>
                                  <option value="بِبا">بِبا</option>
                                  <option value="سمسطا">سمسطا</option>
                                  <option value="الفَشْن">الفَشْن</option>
                                  <option selected disabled value>محافظة الفيوم</option>
                                  <option value="الفُيُّوم">الفُيُّوم</option>
                                  <option value="الفُيُّوم الجديدة">الفُيُّوم الجديدة</option>
                                  <option value="طَامِيِّة">طَامِيِّة</option>
                                  <option value="سنورس">سنورس</option>
                                  <option value="إطسا">إطسا</option>
                                  <option value="إبشواي">إبشواي</option>
                                  <option value="يوسف الصديق">يوسف الصديق</option>
                                  <option selected disabled value>محافظة المنيا</option>
                                  <option value="المنيا">المنيا</option>
                                  <option value="المنيا الجديدة">المنيا الجديدة</option>
                                  <option value="العدوة">العدوة</option>
                                  <option value="مَغَاغَة">مَغَاغَة</option>
                                  <option value="بني مزار">بني مزار</option>
                                  <option value="مَطَاي">مَطَاي</option>
                                  <option value="سَمَالُوط">سَمَالُوط</option>
                                  <option value="المدينة الفكرية">المدينة الفكرية</option>
                                  <option value="مَلّوي">مَلّوي</option>
                                  <option value="دِير مَوَاس">دِير مَوَاس</option>
                                  <option selected disabled value>محافظة أسيوط</option>
                                  <option value="الخَارْجَة">الخَارْجَة</option>
                                  <option value="باريس">باريس</option>
                                  <option value="مُوط">مُوط</option>
                                  <option value="الفرافرة">الفرافرة</option>
                                  <option value="بلاط">بلاط</option>
                                  <option selected disabled value>محافظة البحر الأحمر</option>
                                  <option value="الغردقة">الغردقة</option>
                                  <option value="رأس غارب">رأس غارب</option>
                                  <option value="سفاجا">سفاجا</option>
                                  <option value="القصير">القصير</option>
                                  <option value="مرسى علم">مرسى علم</option>
                                  <option value="الشلاتين">الشلاتين</option>
                                  <option value="حلايب">حلايب</option>
                                  <option selected disabled value>محافظة سوهاج</option>
                                  <option value="سُوهَاج">سُوهَاج</option>
                                  <option value="سوهاج الجديدة">سوهاج الجديدة</option>
                                  <option value="أخميم">أخميم</option>
                                  <option value="أخميم الجديدة">أخميم الجديدة</option>
                                  <option value="البلْيَنا">البلْيَنا</option>
                                  <option value="المراغة">المراغة</option>
                                  <option value="المنشأة">المنشأة</option>
                                  <option value="دار السلام">دار السلام</option>
                                  <option value="جِرجا">جِرجا</option>
                                  <option value="جُهِينَة الغربيّة">جُهِينَة الغربيّة</option>
                                  <option value="ساقلته">ساقلته</option>
                                  <option value="طمَا">طمَا</option>
                                  <option value="طَهُطَا">طَهُطَا</option>
                                  <option selected disabled value>محافظة قنا</option>
                                  <option value="قِنَا">قِنَا</option>
                                  <option value="قنا الجديدة">قنا الجديدة</option>
                                  <option value="أبُو تِشْت">أبُو تِشْت</option>
                                  <option value="نَجْع حَمَّادِي">نَجْع حَمَّادِي</option>
                                  <option value="دِشْنَا">دِشْنَا</option>
                                  <option value="الوَقْف">الوَقْف</option>
                                  <option value="قِفْط">قِفْط</option>
                                  <option value="نَقَادَة">نَقَادَة</option>
                                  <option value="قُوص">قُوص</option>
                                  <option value="فَرْشُوط">فَرْشُوط</option>
                                  <option selected disabled value>محافظة الأقصر</option>
                                  <option value="الأقصر">الأقصر</option>
                                  <option value="الأقصر الجديدة">الأقصر الجديدة</option>
                                  <option value="طِيبة الجديدة">طِيبة الجديدة</option>
                                  <option value="الزينيّة">الزينيّة</option>
                                  <option value="البَيَاضِيّة">البَيَاضِيّة</option>
                                  <option value="القُرْنَة">القُرْنَة</option>
                                  <option value="أَرمَنْت">أَرمَنْت</option>
                                  <option value="الطُّود">الطُّود</option>
                                  <option value="إسنا">إسنا</option>
                                  <option selected disabled value>محافظة أَسْوان</option>
                                  <option value="أَسْوان">أَسْوان</option>
                                  <option value="أَسْوان الجديدة">أَسْوان الجديدة</option>
                                  <option value="دراو">دراو</option>
                                  <option value="كُوم أُمْبُو">كُوم أُمْبُو</option>
                                  <option value="نصر النوبة">نصر النوبة</option>
                                  <option value="كَلَابْشَة">كَلَابْشَة</option>
                                  <option value="إِدفو">إِدفو</option>
                                  <option value="الرِّدِيسيّة">الرِّدِيسيّة</option>
                                  <option value="البِصِيليَّة">البِصِيليَّة</option>
                                  <option value="السباعية">السباعية</option>
                                  <option value="أبو سمبل السياحية">أبو سمبل السياحية</option>
                                  <option selected disabled value>أختر المدينة</option>
                              </select>             
                           </div>

                         </div>
                         <div class="main_city_filter">
                           <!-- city type-->
                          <div class="kind">
                              <select id="select_mainpage_shop" name="filter_city" >
                                  <option selected disabled value>العرض علي الصفحه الرئيسيه</option>
                                  <option value="1">الصفحة الرئيسيه</option>
                                  <option value="0">محل عادي</option>
                                  <option value="2">الكل</option>
                                  
                              </select>             
                           </div>

                         </div>   
                     </div>   


                     <br/>
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl"  id="shop_data">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>إسم المحل</td>
                                <td>الدولة , المحافظة , المدينة</td>
                                <td>العنوان</td>
                                <td>نوع نشاط المحل</td>
                                <td>عرض المحل</td>
                                <td>عدد المنتجات المسموح بها</td>
                                <td>عدد العروض المسموح بها</td>
                              </tr>
                          </tbody>
                          <?php
                                $query_shop="SELECT `id`, `shop_name`, `country`,`government`,`city`, `allowed_products` , `allowed_offers`,`main_page`, `address`,`shop_activity` FROM `shop`";
                                $perform_query_shop=mysqli_query($connect,$query_shop);
                                while($shop_row=mysqli_fetch_assoc($perform_query_shop))
                                {
                                    echo "<tr>";
                                    echo "<td>".$shop_row['id']."</td>";
                                    echo "<td>".$shop_row['shop_name']."</td>";
                                    echo "<td>".$shop_row['country'].",".$shop_row['government'].",".$shop_row['city']."</td>";
                                    echo "<td>".$shop_row['address']."</td>";
                                    echo "<td>";
                                    $quey_shop_activity="SELECT `activity` FROM `shop_activities` WHERE `shop_id`='".$shop_row['id']."' ";
                                    $perform_query_shop_activity=mysqli_query($connect,$quey_shop_activity);
                                    while($row_activity=mysqli_fetch_assoc($perform_query_shop_activity))
                                    {
                                    	echo $row_activity['activity']." - ";	
                                    }
                                    
                                    echo "</td>";
                                    if($shop_row['main_page']=="1")
	                                {
	                                	echo "<td><input type=\"checkbox\" class=\"active_shop\"  checked /><input type=\"hidden\" value=\"".$shop_row['id']."\" class=\"shop_no\"/></td>";	
	                                }else
	                                {
	                                	echo "<td><input type=\"checkbox\"  class=\"active_shop\" /><input type=\"hidden\" value=\"".$shop_row['id']."\" class=\"shop_no\"/></td>";
	                                }
                                    echo "<td>".$shop_row['allowed_products']."</td>";
                                    echo "<td>".$shop_row['allowed_offers']."</td>";
                                    echo "<input type='hidden' class='shop_id' value='".$shop_row['id']."'/>";
                                    echo "</tr>";
                                    
                                }
                              ?>
                      </table>

                      




                </div>
                <!------------------------------------------------------------------------------------------------------->
        </div>
        <!-- end section body -->
        <div class="clear"></div>
        <!-- start section footer -->
        <div class="footer">
            <h4 class="text-center">جميع الحقوق محفوظة 1017 &copy;</h4>
        </div>
        <!-- end section footer -->
        
        
        <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body">
                <h4 class="text-center">
                    <a href="logout/logout.php">تسجيل الخروج</a>
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
        <script src="javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="javascript/jquery.nicescroll.min.js"></script>
        <script src="javascript/index.js"></script>
        <script src="javascript/main_page.js"></script>

        <!-- start filter offer main page -->
        <script type="text/javascript">
	    	$(document).ready(function(){
	    		
	    		function get_offer_search_main_page(search)
	            {
	              // Create our XMLHttpRequest object
	                var hr = new XMLHttpRequest();
	                // Create some variables we need to send to our PHP file    
	                
	                var url = "manage_main_page/get_offer_more_details_main_page_by_mainpage.php";
	                var vars = "search="+search;

	                hr.open("POST", url, true);

	                // Set content type header information for sending url encoded variables in the request
	                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	                // Access the onreadystatechange event for the XMLHttpRequest object
	                hr.onreadystatechange = function() {

	                if(hr.readyState == 4 && hr.status == 200) {
	                    var return_data = hr.responseText;
	                    // console.log("ahmed salem");
	                    // console.log(return_data);
	                    /*****************************************************************************/
	                    var jArraygetpersondetails_search=return_data;

	                    console.log(jArraygetpersondetails_search);
	                    if(jArraygetpersondetails_search!=null)
	                    {
	                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
	                        
	                        $("#offer_data").html('');
	                        $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");

	                        var stringHtml="";
	                        $.each( jArraygetpersondetails_search, function( key, value ){

	                            stringHtml+="<tr>";
	                            stringHtml+="<td>"+value.id+"</td>";
	                            stringHtml+="<td>"+value.from_date+"</td>";
	                            stringHtml+="<td>"+value.to_date+"</td>";
	                            if(value.main_page=="1")
	                            {
	                            	stringHtml+="<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";	
	                            }else
	                            {
	                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";
	                            }
	                            stringHtml+="<td>"+value.offer_name+"</td>";
	                            stringHtml+="<td><img src=\"images/users/"+value.user_id+"/"+value.shop_id+"/offers/"+value.id+"/"+value.offer_photo+"\" style=\"width:50px;height:50px;\"title=\"pic\"/></td>"; 
	                            stringHtml+="<td>"+value.offer_description+"</td>";


	                      		stringHtml+="</tr>";
	                        
	                        

	                        });

	                        $("#offer_data").append(stringHtml+"</tbody>");

	                        
	                        $('.active').change(function() {


							    // this will contain a reference to the checkbox   
							     var row_id=$(this).siblings('.offer_no').val();
					             // alert(row_id);  
					            if (this.checked) {
							        // the checkbox is now checked
							        if(confirm("هل أنت متأكد من تفعيل هذا العرض؟")==true)
					                {
					                   
					                   

					                	active_offer(row_id); 

					                }else
					                {
										alert("لم يتم تفعيل العرض.");                        
					                }
							        
							    }else
							    {
							    	deactive_offers(row_id);
							    }
							});
	                        
	                                   
	                                  
	                    }else{
	                            $("#offer_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
	                    }



	                }else{
	                    $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");
	                    $("#offer_data").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
	                  
	                }

	                    /*****************************************************************************/






	                    

	                };

	                hr.send(vars); // Actually execute the request

	            }
				

	            $( "#select_main_page_offer" ).change(function() {
	              var search1=$( "#select_main_page_offer" ).val();
	              // alert(search1);
	              get_offer_search_main_page(search1)
	            });




	    	});
	    </script>
        <!-- end filter offer  main page -->
        
        <!-- start filter offer city -->
        <script type="text/javascript">
	    	$(document).ready(function(){
	    		function get_offer_search_city(search)
	            {
	              // Create our XMLHttpRequest object
	                var hr = new XMLHttpRequest();
	                // Create some variables we need to send to our PHP file    
	                
	                var url = "manage_main_page/get_offer_more_details_main_page_by_city.php";
	                var vars = "search="+search;

	                hr.open("POST", url, true);

	                // Set content type header information for sending url encoded variables in the request
	                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	                // Access the onreadystatechange event for the XMLHttpRequest object
	                hr.onreadystatechange = function() {

	                if(hr.readyState == 4 && hr.status == 200) {
	                    var return_data = hr.responseText;
	                    // console.log("ahmed salem");
	                    // console.log(return_data);
	                    /*****************************************************************************/
	                    var jArraygetpersondetails_search=return_data;

	                    console.log(jArraygetpersondetails_search);
	                    if(jArraygetpersondetails_search!=null)
	                    {
	                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
	                        
	                        $("#offer_data").html('');
	                        $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");

	                        var stringHtml="";
	                        $.each( jArraygetpersondetails_search, function( key, value ){

	                            stringHtml+="<tr>";
	                            stringHtml+="<td>"+value.id+"</td>";
	                            stringHtml+="<td>"+value.from_date+"</td>";
	                            stringHtml+="<td>"+value.to_date+"</td>";
	                            if(value.main_page=="1")
	                            {
	                            	stringHtml+="<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";	
	                            }else
	                            {
	                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";
	                            }
	                            stringHtml+="<td>"+value.offer_name+"</td>";
	                            stringHtml+="<td><img src=\"images/users/"+value.user_id+"/"+value.shop_id+"/offers/"+value.id+"/"+value.offer_photo+"\" style=\"width:50px;height:50px;\"title=\"pic\"/></td>"; 
	                            stringHtml+="<td>"+value.offer_description+"</td>";


	                      		stringHtml+="</tr>";
	                        
	                        

	                        });

	                        $("#offer_data").append(stringHtml+"</tbody>");

	                        
	                        $('.active').change(function() {


							    // this will contain a reference to the checkbox   
							     var row_id=$(this).siblings('.offer_no').val();
					             // alert(row_id);  
					            if (this.checked) {
							        // the checkbox is now checked
							        if(confirm("هل أنت متأكد من تفعيل هذا العرض؟")==true)
					                {
					                   
					                   

					                	active_offer(row_id); 

					                }else
					                {
										alert("لم يتم تفعيل العرض.");                        
					                }
							        
							    }else
							    {
							    	deactive_offers(row_id);
							    }
							});
	                        
	                                   
	                                  
	                    }else{
	                            $("#offer_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
	                    }



	                }else{
	                    $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");
	                    $("#offer_data").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
	                  
	                }

	                    /*****************************************************************************/






	                    

	                };

	                hr.send(vars); // Actually execute the request

	            }
				

	            $( "#select_city_offer" ).change(function() {
	              var search1=$( "#select_city_offer" ).val();
	              // alert(search1);
	              get_offer_search_city(search1)
	            });




	    	});

        </script>
        <!-- end filter offer city -->
       
      	<!-- start search about offers -->
      	<script type="text/javascript">
  		 $(document).ready(function(){
  		 	function get_offer_search(search)
            {
              // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                
                var url = "manage_main_page/get_offer_more_details_main_page.php";
                var vars = "search="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    // console.log("ahmed salem");
                    // console.log(return_data);
                    /*****************************************************************************/
                    var jArraygetpersondetails_search=return_data;

                    // console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#offer_data").html('');
                        $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<tr>";
                            stringHtml+="<td>"+value.id+"</td>";
                            stringHtml+="<td>"+value.from_date+"</td>";
                            stringHtml+="<td>"+value.to_date+"</td>";
                            if(value.main_page=="1")
                            {
                            	stringHtml+="<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";	
                            }else
                            {
                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"offer_no\"/></td>";
                            }
                            stringHtml+="<td>"+value.offer_name+"</td>";
                            stringHtml+="<td><img src=\"images/users/"+value.user_id+"/"+value.shop_id+"/offers/"+value.id+"/"+value.offer_photo+"\" style=\"width:50px;height:50px;\"title=\"pic\"/></td>"; 
                            stringHtml+="<td>"+value.offer_description+"</td>";


                      		stringHtml+="</tr>";
                        
                        

                        });

                        $("#offer_data").append(stringHtml+"</tbody>");

                        
                        $('.active').change(function() {


						    // this will contain a reference to the checkbox   
						     var row_id=$(this).siblings('.offer_no').val();
				             // alert(row_id);  
				            if (this.checked) {
						        // the checkbox is now checked
						        if(confirm("هل أنت متأكد من تفعيل هذا العرض؟")==true)
				                {
				                   
				                   

				                	active_offer(row_id); 

				                }else
				                {
									alert("لم يتم تفعيل العرض.");                        
				                }
						        
						    }else
						    {
						    	deactive_offers(row_id);
						    }
						});
                        
                                   
                                  
                    }else{
                            $("#offer_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#offer_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>تاريخ بداية العرض</td><td>تاريخ نهاية العرض</td><td>عرض علي الصفحة الرئيسية</td><td>أسم العرض</td><td>صورة العرض</td><td>وصف العرض</td></tr></tbody>");
                    $("#offer_data").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                  
                }

                    /*****************************************************************************/






                    

                };

                hr.send(vars); // Actually execute the request

            }
                        

            $("#search_offer").on("keyup",function(){
                var search=$(this).val();
                // alert(search);
                get_offer_search(search);
            });


  		 });

      	</script>
      	<!-- end search about offers -->


        <!-- start shop search section -->
        <script type="text/javascript">

          $(document).ready(function(){


        

            function get_shop_search(search)
            {
              // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "manage_main_page/get_shop_more_details_main_page.php";
                var vars = "search="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    // console.log("ahmed salem");
                    // console.log(return_data);
                    /*****************************************************************************/
                    var jArraygetpersondetails_search=return_data;

                    // console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#shop_data").html('');
                        $("#shop_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<tr>";
                            stringHtml+="<td>"+value.id+"</td>";
                            stringHtml+="<td>"+value.shop_name+"</td>";
                            stringHtml+="<td>"+value.country+","+value.government+","+value.city+"</td>";
                            stringHtml+="<td>"+value.address+"</td>";
                            stringHtml+="<td>";
                            stringHtml+= value.shop_activity+" - ";	
                            
                            stringHtml+="</td>";
                            if(value.main_page=="1")
                            {
                            	stringHtml+="<td><input type=\"checkbox\" class=\"active_shop\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";	
                            }else
                            {
                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active_shop\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";
                            }
                            stringHtml+="<td>"+value.allowed_products+"</td>";
                            stringHtml+="<td>"+value.allowed_offers+"</td>";
                            stringHtml+="<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+="</tr>";
                            
                        

                        });

                        $("#shop_data").append(stringHtml+"</tbody>");

                        $('.active_shop').change(function() {


						    // this will contain a reference to the checkbox   
						     var row_id=$(this).siblings('.shop_no').val();
				             // alert(row_id);  
				            if (this.checked) {
						        // the checkbox is now checked
						        if(confirm("هل أنت متأكد من تفعيل هذا المحل")==true)
				                {
				                   
				                   

				                	active_shop(row_id); 

				                }else
				                {
									alert("لم يتم تفعيل المحل.");                        
				                }
						        
						    }else
						    {
						    	deactive_shop(row_id);
						    }
						});
                        

                        
                                   
                                  
                    }else{
                            $("#shop_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#shop_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");
                    $("#shop_data").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                  
                }

                    /*****************************************************************************/






                    

                };

                hr.send(vars); // Actually execute the request

            }
                        


            $("#search_shop").on("keyup",function(){
                var search=$(this).val();
                // alert(search);
                get_shop_search(search);
            });



            /***************************************************************/

           





          });
            

            


        </script>
        <!-- end shop search section -->


        <!-- start logout script-->
        <script type="text/javascript">
		    $(document).ready(function(){
            $("#logout").click(function(){
                $('#Message').modal('show');   
            });
        	 
            $(".shop_activity_info").click(function(){
            	var shop_id=$(this).siblings(".shop_id").val();

                get_shop_activities(shop_id);
                $('#Message_shop_activity').modal('show');   
            });


            function get_shop_activities(shop_id)
            {
            	// Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "get_information/get_more_shop_activities.php";
                var vars = "shop_id="+shop_id;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;

                    var jArraygetpersondetails=return_data;

                    console.log(jArraygetpersondetails);
                    $(".fading_opacity .mod_dio .mod_con .mod_body1").html('');
                    if(jArraygetpersondetails!=null)
	                    {
                        
                       
                            
                            //person
                            $(".fading_opacity .mod_dio .mod_con .mod_body1").html(jArraygetpersondetails+"");


                      

                    }else{
                        $(".fading_opacity .mod_dio .mod_con .mod_body1").html('<h3 style=\'color:#ff0000;\'>Something Going Wrong ....</h3>');
                    }



                }else{
                    //alert("i'm working");
                }
                };
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }
		});
	   </script>
        <!-- end logout script-->

       
        
        <!--shop city filter --->

        <script type="text/javascript">
            
            function get_shop_filter_city_search(search)
            {
                
                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "manage_main_page/get_shop_more_details_main_page_by_city.php";
                var search=search;
                var vars = "search_city="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    // console.log("ahmed salem");
                    console.log(return_data);

                    /******************************************************************************/

                    var jArraygetpersondetails_search=return_data;

                    console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#shop_data").html('');
                        $("#shop_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<tr>";
                            stringHtml+="<td>"+value.id+"</td>";
                            stringHtml+="<td>"+value.shop_name+"</td>";
                            stringHtml+="<td>"+value.country+","+value.government+","+value.city+"</td>";
                            stringHtml+="<td>"+value.address+"</td>";
                            stringHtml+="<td>";
                            stringHtml+= value.shop_activity+" - ";	
                            
                            stringHtml+="</td>";
                            if(value.main_page=="1")
                            {
                            	stringHtml+="<td><input type=\"checkbox\" class=\"active_shop\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";	
                            }else
                            {
                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active_shop\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";
                            }
                            stringHtml+="<td>"+value.allowed_products+"</td>";
                            stringHtml+="<td>"+value.allowed_offers+"</td>";
                            stringHtml+="<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+="</tr>";
                            
                        

                        });

                        $("#shop_data").append(stringHtml+"</tbody>");

                        

                       $('.active_shop').change(function() {


						    // this will contain a reference to the checkbox   
						     var row_id=$(this).siblings('.shop_no').val();
				             // alert(row_id);  
				            if (this.checked) {
						        // the checkbox is now checked
						        if(confirm("هل أنت متأكد من تفعيل هذا المحل")==true)
				                {
				                   
				                   

				                	active_shop(row_id); 

				                }else
				                {
									alert("لم يتم تفعيل المحل.");                        
				                }
						        
						    }else
						    {
						    	deactive_shop(row_id);
						    }
						});





                                   
                    }else{
                            $("#shop_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");
                    $("#statistic_tbl_shop").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                }
                    /******************************************************************************/

                
              
            

              };
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }



            $( "#select_city_shop" ).change(function() {
              var search1=$( "#select_city_shop" ).val();
              // alert(search1);
              get_shop_filter_city_search(search1)
            });


             

            /*********************************************************************/


            function get_shop_filter_main_page_search(search)
            {
                
                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "manage_main_page/get_shop_more_details_main_page_by_mainpage.php";
                var search=search;
                var vars = "search_main_page="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    // console.log("ahmed salem");
                    console.log(return_data);

                    /******************************************************************************/

                    var jArraygetpersondetails_search=return_data;

                    console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#shop_data").html('');
                        $("#shop_data").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+="<tr>";
                            stringHtml+="<td>"+value.id+"</td>";
                            stringHtml+="<td>"+value.shop_name+"</td>";
                            stringHtml+="<td>"+value.country+","+value.government+","+value.city+"</td>";
                            stringHtml+="<td>"+value.address+"</td>";
                            stringHtml+="<td>";
                            stringHtml+= value.shop_activity+" - ";	
                            
                            stringHtml+="</td>";
                            if(value.main_page=="1")
                            {
                            	stringHtml+="<td><input type=\"checkbox\" class=\"active_shop\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";	
                            }else
                            {
                            	stringHtml+="<td><input type=\"checkbox\"  class=\"active_shop\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";
                            }
                            stringHtml+="<td>"+value.allowed_products+"</td>";
                            stringHtml+="<td>"+value.allowed_offers+"</td>";
                            stringHtml+="<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+="</tr>";
                            
                        

                        });

                        $("#shop_data").append(stringHtml+"</tbody>");

                        

            			           

                        $('.active_shop').change(function() {


						    // this will contain a reference to the checkbox   
						     var row_id=$(this).siblings('.shop_no').val();
				             // alert(row_id);  
				            if (this.checked) {
						        // the checkbox is now checked
						        if(confirm("هل أنت متأكد من تفعيل هذا المحل")==true)
				                {
				                   
				                   

				                	active_shop(row_id); 

				                }else
				                {
									alert("لم يتم تفعيل المحل.");                        
				                }
						        
						    }else
						    {
						    	deactive_shop(row_id);
						    }
						});



                                   
                    }else{
                            $("#shop_data").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عرض المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td></tr></tbody>");
                    $("#statistic_tbl_shop").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                }
                    /******************************************************************************/

                
              
            

              };
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }



            $( "#select_mainpage_shop" ).change(function() {
              var search1=$( "#select_mainpage_shop" ).val();
              // alert(search1);
              get_shop_filter_main_page_search(search1)
            });

        </script>


        <!-- city filter -->

        <!-- offer activate -->
        <script type="text/javascript">
    		
    		$('.active').change(function() {


		    // this will contain a reference to the checkbox   
		     var row_id=$(this).siblings('.offer_no').val();
             // alert(row_id);  
            if (this.checked) {
		        // the checkbox is now checked
		        if(confirm("هل أنت متأكد من تفعيل هذا العرض؟")==true)
                {
                   
                   

                	active_offer(row_id); 

                }else
                {
					alert("لم يتم تفعيل العرض.");                        
                }
		        
		    }else
		    {
		    	deactive_offers(row_id);
		    }
		});

		function active_offer(row_id)
		{
			
			// Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file    
            var row_id=row_id;
            var url = "manage_main_page/active_paid_offer.php";
            var vars = "offer_id="+row_id;

            hr.open("POST", url, true);
        
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
            
            if(hr.readyState == 4 && hr.status == 200) {
                	var return_data = hr.responseText;
                
            		
                	alert(return_data);

            	}


        	};

        	 hr.send(vars); // Actually execute the request
            
		}

		function deactive_offers(row_id)
		{
			
			// Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file    
            var row_id=row_id;
            var url = "manage_main_page/deactive_paid_offer.php";
            var vars = "offer_id="+row_id;

            hr.open("POST", url, true);
        
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
            
            if(hr.readyState == 4 && hr.status == 200) {
                	var return_data = hr.responseText;
                
            		
                	alert(return_data);

            	}


        	};

        	 hr.send(vars); // Actually execute the request
            
		}

        </script>
        <!--end offer activate -->
        <!-- shop activate -->
        <script type="text/javascript">
    		
    		$('.active_shop').change(function() {


		    // this will contain a reference to the checkbox   
		     var row_id=$(this).siblings('.shop_no').val();
             // alert(row_id);  
            if (this.checked) {
		        // the checkbox is now checked
		        if(confirm("هل أنت متأكد من تفعيل هذا المحل")==true)
                {
                   
                   

                	active_shop(row_id); 

                }else
                {
					alert("لم يتم تفعيل المحل.");                        
                }
		        
		    }else
		    {
		    	deactive_shop(row_id);
		    }
		});

		function active_shop(row_id)
		{
			
			// Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file    
            var row_id=row_id;
            var url = "manage_main_page/active_paid_shop.php";
            var vars = "shop_id="+row_id;

            hr.open("POST", url, true);
        
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
            
            if(hr.readyState == 4 && hr.status == 200) {
                	var return_data = hr.responseText;
                
            		
                	alert(return_data);

            	}


        	};

        	 hr.send(vars); // Actually execute the request
            
		}

		function deactive_shop(row_id)
		{
			
			// Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file    
            var row_id=row_id;
            var url = "manage_main_page/deactive_paid_shop.php";
            var vars = "shop_id="+row_id;

            hr.open("POST", url, true);
        
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
            
            if(hr.readyState == 4 && hr.status == 200) {
                	var return_data = hr.responseText;
                
            		
                	alert(return_data);

            	}


        	};

        	 hr.send(vars); // Actually execute the request
            
		}

        </script>
        <!--end offer activate -->
        <!-- search shop-->

    </body> 
</html>