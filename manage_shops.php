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
            
                <div class="right_list">
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
                            <li class="active"><a href="manage_shops.php"><i class="fa fa-bell "></i> <span>إدارة المحلات</span></a></li>
                            <li><a href="manage_main_page.php"><i class="fa fa-bell "></i> <span>إدارة الصفحة الرئيسية App</span></a></li>
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
                <div class="left_content">
                    
                    <h4>لوحة تحكم محلاتي<span>/&nbsp;&nbsp;إدارة المحلات</span> </h4>
                        
                      <div class="box">
                         
                         <div class="filter">
                             <input type="text" id="search_shop" name="search_shop" placeholder="أبحث باسم المحل ...">
                         </div>
                         <div class="city_filter">
                           <!-- city type-->
                          <div class="kind">
                              <select id="select_city" name="filter_city" >
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
                     </div>   
                   
                      <!-- Table -->
                      <table class="table table-bordered statistic_tbl" id="statistic_tbl_shop">
                          <tbody>
                              <tr class="active">
                                <td>رقم المسلسل</td>
                                <td>إسم المحل</td>
                                <td>الدولة , المحافظة , المدينة</td>
                                <td>العنوان</td>
                                <td>نوع نشاط المحل</td>
                                <td>عدد المنتجات المسموح بها</td>
                                <td>عدد العروض المسموح بها</td>
                                <td>التفعيل</td>
                                <td>الصلاحيات</td>
                              </tr>
                              
                              <?php
                                $query_shop="SELECT `id`, `shop_name`, `user_id`, `country`,`government`,`city`, `allowed_products` , `allowed_offers`, `address`,`shop_activity`,`approve` FROM `shop`";
                                $perform_query_shop=mysqli_query($connect,$query_shop);
                                while($shop_row=mysqli_fetch_assoc($perform_query_shop))
                                {
                                    echo "<tr>";
                                    echo "<td>".$shop_row['id']."</td>";
                                    echo "<td>".$shop_row['shop_name']."</td>";
                                    echo "<td>".$shop_row['country'].",".$shop_row['government'].",".$shop_row['city']."</td>";
                                    echo "<td>".$shop_row['address']."</td>";
                                    echo "<td>";
                                    echo "<i class=\"fa fa-info fa-lg shop_activity_info\"></i>";
                                    echo "<input type='hidden' class='shop_id' value='".$shop_row['id']."'/>";
                                    echo "</td>";
                                    echo "<td>".$shop_row['allowed_products']."</td>";
                                    echo "<td>".$shop_row['allowed_offers']."</td>";
                                    if($shop_row['approve']=="1")
                                      {
                                        echo "<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\"".$shop_row['id']."\" class=\"shop_no\"/></td>";	
                                      }else
                                      {
                                        echo "<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\"".$shop_row['id']."\" class=\"shop_no\"/></td>";
                                      }
                                    echo "<input type='hidden' class='shop_id' value='".$shop_row['id']."'/>";
                                    echo "<td>
                                    <a href=\"manage_shop_setting/edit_shop.php?s_id=".$shop_row['id']."\">
                                    <i class=\"fa fa-edit\"></i>
                                    </a>
                                    &nbsp;&nbsp;
                                    <i class=\"fa fa-trash-o delete_shop\"></i>
                                    &nbsp;&nbsp;
                                    <a href=\"manage_shop_setting/more_shop_info.php?s_id=".$shop_row['id']."&u_id=".$shop_row['user_id']."\">
                                    <i class=\"fa fa-info\"></i>
                                    </a>
                                    </td>";
                                    
                                    echo "</tr>";
                                    
                                }
                              ?>
                          </tbody>
                          
                      </table>
                   

                </div>
            
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

        <!-- pop up of logout model -->
        <!-- Modal -->
        <div class="modal fade fading_opacity" id="Message_shop_activity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="modal-dialog mod_dio" role="document">

            <div class="modal-content mod_con">

              <div class="modal-body mod_body mod_body1">

                  <table style="overflow:scroll;">
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_1">    
                              <label>ملابس أطفال</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_2">  
                              <label>ملابس رجالي</label> 
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_3">    
                              <label>ملابس حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_4">    
                              <label>أحذية رجالي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_5">    
                              <label>أحذية حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_6">    
                              <label>الموبايلات</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_7">    
                              <label>إلكترونيات وكمبيوترات</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_8">    
                              <label>سوبر ماركت</label>    
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_9">    
                              <label>أقمشة</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_10">    
                              <label>مطاعم</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_11">    
                              <label>أجهزة كهربية وإلكترونية</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_12">    
                              <label>العاب أطفال</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_13">    
                              <label>حلويات</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_14">    
                              <label>خضروات وفاكهة</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_15">    
                              <label>مستلزمات رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_16">    
                              <label>مستلزمات حريمي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_17">    
                              <label>سجاد ومفروشات</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_18">    
                              <label>سيراميك ومواد صحية</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_19">    
                              <label>شركات السفر والسياحة</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_20">    
                              <label>صيدليات</label>
                            </p>
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_21">    
                              <label>محلات عطور وبخور</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_22">    
                              <label>مكاتب وأدوات مكتبية</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_23">    
                              <label>لحوم حمراء وبيضاء</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_24">    
                              <label>مغسلة</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_25">    
                              <label>مقاهي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_26">    
                              <label>مواد تنظيف</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_27">    
                              <label>معدات سيارات</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_28">    
                              <label>كوافير حريمي</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_29">    
                              <label>كوافير رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_30">    
                              <label>أتيليه رجالي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_31">    
                              <label>أتيليه حريمي</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_32">    
                              <label>العطار</label>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_33">    
                              <label>أدوات كهربية</label>
                            </p>
                        </td>
                        <td>
                            <p style="margin-right:10px;margin-left:10px;">
                              <input type="checkbox" name="activity_34">    
                              <label>إستوديوهات وفوتوجرافيك</label>
                            </p>
                        </td>
                        
                    </tr>  
                  </table>
                                   
                               
                               
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

       

        <!-- start search section -->
        <script type="text/javascript">

          $(document).ready(function(){


            // function get_shop_search(search)
            // {
                
            //     // Create our XMLHttpRequest object
            //     var hr = new XMLHttpRequest();
            //     // Create some variables we need to send to our PHP file    
            //     var search=search;
            //     // var url = "get_information/get_user_more_details_search.php";
            //     var url = "get_information/get_shop_more_details_search.php";
            //     var vars = "search="+search;

            //     hr.open("POST", url, true);
            
            //     // Set content type header information for sending url encoded variables in the request
            //     hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //     // alert(555);
            //     // Access the onreadystatechange event for the XMLHttpRequest object
            //     hr.onreadystatechange = function() {
                

            //     if(hr.readyState == 4 && hr.status == 100) {
            //         var return_data = hr.responseText;
            //         alert(return_data);    
                    
            //     }

            //   };

            //   // Send the data to PHP now... and wait for response to update the status div
            //   hr.send(vars); // Actually execute the request

            // }       



            function get_shop_search(search)
            {
              // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "get_information/get_shop_more_details_search.php";
                var vars = "search="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    console.log("ahmed salem");
                    console.log(return_data);
                    /*****************************************************************************/
                    var jArraygetpersondetails_search=return_data;

                    // console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#statistic_tbl_shop").html('');
                        $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td><td>التفعيل</td><td>الصلاحيات</td></tr>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+= "<tr>";
                            stringHtml+= "<td>"+value.id+"</td>";
                            stringHtml+= "<td>"+value.shop_name+"</td>";
                            stringHtml+= "<td>"+value.country+","+value.government+","+value.city+"</td>";
                            stringHtml+= "<td>"+value.address+"</td>";
                            stringHtml+="<td>"; 
                            stringHtml+="<i class=\"fa fa-info fa-lg shop_activity_info\"></i>";
                            stringHtml+="<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+="</td>";


                            stringHtml+= "<td>"+value.allowed_products+"</td>";
                            stringHtml+= "<td>"+value.allowed_offers+"</td>";

                            if(value.approve=="1")
	                          {
	                            stringHtml+="<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";	
	                          }else
	                          {
	                            stringHtml+="<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";
	                          }


                            stringHtml+= "<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+= "<td><a href=\"manage_shop_setting/edit_shop.php?s_id="+value.id+"\"><i class=\"fa fa-edit\"></i></a>&nbsp;&nbsp;<i class=\"fa fa-trash-o delete_shop\"></i>&nbsp;&nbsp;<a href=\"manage_shop_setting/more_shop_info.php?s_id="+value.id+"&u_id="+value.user_id+"\"><i class=\"fa fa-info\"></i></a></td>";
                            
                            stringHtml+= "</tr>";
                            
                        

                        });

                        $("#statistic_tbl_shop").append(stringHtml+"</tbody> سيبيبسي");

                        

                        //for delete shops
                        $('.delete_shop').click(function(){
                            $(this).parent().parent().hide();
                           
                            var shop_id = $(this).parent().siblings('.shop_id').val();
                            // alert(account_id);
                            if(confirm("هل أنت متاكد ؟")==true)
                            {
                                // alert("oki");
                                delete_shop(shop_id);
                            }else
                            {
                                alert("لم يتم حذف المستخدم.");
                            }
                            
                        });
                                   
                        $(".shop_activity_info").click(function(){
                          var shop_id=$(this).siblings(".shop_id").val();

                            get_shop_activities(shop_id);
                            $('#Message_shop_activity').modal('show');   
                        }); 

                        /********** active the shop **********************/
                        $('.active').change(function() {
					            // this will contain a reference to the checkbox   
					            var row_id=$(this).siblings('.shop_no').val();
					            // alert(row_id+"");            
					              if (this.checked) {
					            // the checkbox is now checked
					            if(confirm("هل انت متاكد من تفعيل هذا المحل؟")==true)
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
                            $("#statistic_tbl_shop").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td><td>الصلاحيات</td></tr>");
                    $("#statistic_tbl_shop").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                  
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

            /*********************************************************************/






          });
            

            


        </script>
        <!-- end search section -->


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

        <!-- start delete shop -->
        <script type="text/javascript">
            $('.delete_shop').click(function(){
                $(this).parent().parent().hide();
               
                var shop_id = $(this).parent().siblings('.shop_id').val();
                // alert(shop_id);
                if(confirm("هل أنت متاكد ؟")==true)
                {
                    // alert("oki");
                    delete_shop(shop_id);
                }else
                {
                    alert("لم يتم حذف المستخدم.");
                }
                
            });

            /****************************************************/
            
            /******************************************************/
            function delete_shop(shop_id)
            {
          
                  // Create our XMLHttpRequest object
                  var hr = new XMLHttpRequest();
                  // Create some variables we need to send to our PHP file    
              
                  var url = "manage_shop_setting/delete_shop.php";
                  var vars = "shop_id="+shop_id;

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
        <!-- end delete shop -->
        
        <!-- city filter --->

        <script type="text/javascript">
            
            function get_shop_filter_city_search(search)
            {
                



                // Create our XMLHttpRequest object
                var hr = new XMLHttpRequest();
                // Create some variables we need to send to our PHP file    
                var shop_id=shop_id;
                var url = "get_information/get_shop_more_details_search_filter_city.php";
                var search=search;
                var vars = "search_city="+search;

                hr.open("POST", url, true);

                // Set content type header information for sending url encoded variables in the request
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {

                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    console.log("ahmed salem");
                    console.log(return_data);

                    /******************************************************************************/

                    var jArraygetpersondetails_search=return_data;

                    console.log(jArraygetpersondetails_search);
                    if(jArraygetpersondetails_search!=null)
                    {
                        jArraygetpersondetails_search=JSON.parse(jArraygetpersondetails_search);    
                        
                        $("#statistic_tbl_shop").html('');
                        $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة , المحافظة , المدينة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td><td>التفعيل</td><td>الصلاحيات</td></tr>");

                        var stringHtml="";
                        $.each( jArraygetpersondetails_search, function( key, value ){

                            stringHtml+= "<tr>";
                            stringHtml+= "<td>"+value.id+"</td>";
                            stringHtml+= "<td>"+value.shop_name+"</td>";
                            stringHtml+= "<td>"+value.country+","+value.government+","+value.city+"</td>";
                            stringHtml+= "<td>"+value.address+"</td>";
                            stringHtml+="<td>"; 
                            stringHtml+="<i class=\"fa fa-info fa-lg shop_activity_info\"></i>";
                            stringHtml+="<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+="</td>";

                            stringHtml+= "<td>"+value.allowed_products+"</td>";
                            stringHtml+= "<td>"+value.allowed_offers+"</td>";
                             if(value.approve=="1")
	                          {
	                            stringHtml+="<td><input type=\"checkbox\" class=\"active\"  checked /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";	
	                          }else
	                          {
	                            stringHtml+="<td><input type=\"checkbox\"  class=\"active\" /><input type=\"hidden\" value=\""+value.id+"\" class=\"shop_no\"/></td>";
	                          }
                            stringHtml+= "<input type='hidden' class='shop_id' value='"+value.id+"'/>";
                            stringHtml+= "<td><a href=\"manage_shop_setting/edit_shop.php?s_id="+value.id+"\"><i class=\"fa fa-edit\"></i></a>&nbsp;&nbsp;<i class=\"fa fa-trash-o delete_shop\"></i>&nbsp;&nbsp;<a href=\"manage_shop_setting/more_shop_info.php?s_id="+value.id+"&u_id="+value.user_id+"\"><i class=\"fa fa-info\"></i></a></td>";
                            
                            stringHtml+= "</tr>";
                            
                        

                        });

                        $("#statistic_tbl_shop").append(stringHtml+"</tbody> سيبيبسي");

                        

                        //for delete shops
                        $('.delete_shop').click(function(){
                            $(this).parent().parent().hide();
                           
                            var shop_id = $(this).parent().siblings('.shop_id').val();
                            // alert(account_id);
                            if(confirm("هل أنت متاكد ؟")==true)
                            {
                                // alert("oki");
                                delete_shop(shop_id);
                            }else
                            {
                                alert("لم يتم حذف المستخدم.");
                            }
                            
                        });


                        $(".shop_activity_info").click(function(){
                          var shop_id=$(this).siblings(".shop_id").val();

                            get_shop_activities(shop_id);
                            $('#Message_shop_activity').modal('show');   
                        }); 

                        /********** active the shop **********************/
                        $('.active').change(function() {
					            // this will contain a reference to the checkbox   
					            var row_id=$(this).siblings('.shop_no').val();
					            // alert(row_id+"");            
					              if (this.checked) {
					            // the checkbox is now checked
					            if(confirm("هل انت متاكد من تفعيل هذا المحل؟")==true)
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
                            $("#statistic_tbl_shop").html("<td colspan='5'><h4 class='text-center' style='color:#ff0000'>There's No Result for Your Query...</h4></td>");
                    }



                }else{
                    $("#statistic_tbl_shop").html("<tbody><tr class=\"active\"><td>رقم المسلسل</td><td>إسم المحل</td><td>الدولة</td><td>العنوان</td><td>نوع نشاط المحل</td><td>عدد المنتجات المسموح بها</td><td>عدد العروض المسموح بها</td><td>الصلاحيات</td></tr>");
                    $("#statistic_tbl_shop").append("<tr><td colspan='8'><h4 class='text-center'>There's No Result for Your Query...</h4></td></tr></tbody>");
                }
                    /******************************************************************************/

                
              
            

              };
                // Send the data to PHP now... and wait for response to update the status div
                hr.send(vars); // Actually execute the request

            }



            $( "#select_city" ).change(function() {
              var search1=$( "#select_city" ).val();
              // alert(search);
              get_shop_filter_city_search(search1)
            });


             /***************************************************************/

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

            /*********************************************************************/




        </script>


        <!-- city filter -->




        <!--- start approve action -->
        <script type="text/javascript">
        	
            $('.active').change(function() {
                // this will contain a reference to the checkbox   
                var row_id=$(this).siblings('.shop_no').val();
                // alert(row_id+"");            
                  if (this.checked) {
                // the checkbox is now checked
                if(confirm("هل انت متاكد من تفعيل هذا المحل؟")==true)
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
                  var url = "manage_shop_setting/active_shop.php";
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
                  var url = "manage_shop_setting/deactive_shop.php";
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
        <!--- end approve action -->
    </body> 
</html>