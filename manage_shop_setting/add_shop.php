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
        <link href="../css/bootstrap.css" rel="stylesheet"/>
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
        <div class="body_content container">
      	 <div class="add_user add_shop">
                <form action="add_shop_background.php" method="POST" id="add_shop_submit" enctype="multipart/form-data">
                    <h4 class="text-center">إضافة بيانات المحل</h4>
                        <br/>
                        <input type="text" id="add_shop" placeholder="أدخل أسم المحل"  name="add_shop_name" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_Shop_Name">خطأ كبير يا نجم</p>
                        <input type="text" id="add_shop_address" placeholder="أدخل عنوان المحل"  name="add_address" class="input" />
                        <br/><br/>
                        <p class="error" id="Error_shop_address">خطأ كبير يا نجم</p>
                        
                        <div class="upload_photo_container">
                            
                                <div class="file-input wrapper photo_btn">
                                                       
                                        <input id="add_photo" type="file" name="image_shop"  class="file-input control" />
                                        <div class="file-input content">
                                            <div class="upload_image_box">
                                            <h4 class="text-center">تحميل صورة للمحل</h4>
                                            </div> 
                                        </div>
                                 </div>
                             
                        </div>
                         <p class="error" id="Error_photo">خطأ كبير يا نجم</p>
                         <!-- country type-->
                          <div class="kind">
                              <select id="add_country" name="country" >
                                  <option selected disabled value>الدولة</option>
                                  <option value="مصر">مصر</option>
                                  <option value="إيران">إيران</option>
                                  <option value="تركيا">تركيا</option>
                                  <option value="العراق">العراق</option>
                                  <option value="السعودية">السعودية</option>
                                  <option value="اليمن">اليمن</option>
                                  <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
                                  <option value="فلسطين">فلسطين</option>
                                  <option value="لبنان">لبنان</option>
                                  <option value="عمان">عمان</option>
                                  <option value="قطر">قطر</option>
                                  <option value="البحرين">البحرين</option>
                                  <option value="تونس">تونس</option>
                                  <option value="الجزائر">الجزائر</option>
                                  <option value="ليبيا">ليبيا</option>
                                  <option value="المغرب">المغرب</option>
                                  <option value="موريتنيا">موريتنيا</option>
                              </select>             
                           </div>
                           <p class="error" id="Error_country">خطأ كبير يا نجم</p>
                           <!-- government type-->
                          <div class="kind">
                              <select id="add_government" name="government" >
                                  <option selected disabled value>أختر المحافظة</option>
                                  <option value="محافظة القاهرة">محافظة القاهرة</option>
                                  <option value="محافظة الجِيزَة">محافظة الجِيزَة</option>
                                  <option value="محافظة القليوبية">محافظة القليوبية</option>
                                  <option value="محافظة الإسكندرية">محافظة الإسكندرية</option>
                                  <option value="محافظة البحيرة">محافظة البحيرة</option>
                                  <option value="محافظة مطروح">محافظة مطروح</option>
                                  <option value="محافظة دمياط">محافظة دمياط</option>
                                  <option value="محافظة الدقهلية">محافظة الدقهلية</option>
                                  <option value="محافظة كفر الشيخ">محافظة كفر الشيخ</option>
                                  <option value="محافظة الغربية">محافظة الغربية</option>
                                  <option value="محافظة المنوفية">محافظة المنوفية</option>
                                  <option value="محافظة الشرقية">محافظة الشرقية</option>
                                  <option value="محافظة بورسعيد">محافظة بورسعيد</option>
                                  <option value="محافظة الإسماعيلية">محافظة الإسماعيلية</option>
                                  <option value="محافظة السويس">محافظة السويس</option>
                                  <option value="محافظة شمال سيناء">محافظة شمال سيناء</option>
                                  <option value="محافظة جنوب سيناء">محافظة جنوب سيناء</option>
                                  <option value="محافظة بني سويف">محافظة بني سويف</option>
                                  <option value="محافظة الفيوم">محافظة الفيوم</option>
                                  <option value="محافظة المنيا">محافظة المنيا</option>
                                  <option value="محافظة أسيوط">محافظة أسيوط</option>
                                  <option value="محافظة البحر الأحمر">محافظة البحر الأحمر</option>
                                  <option value="محافظة سوهاج">محافظة سوهاج</option>
                                  <option value="محافظة قنا">محافظة قنا</option>
                                  <option value="محافظة الأقصر">محافظة الأقصر</option>
                                  <option value="محافظة أَسْوان">محافظة أَسْوان</option>
                              </select>             
                           </div>
                           <p class="error" id="Error_government">خطأ كبير يا نجم</p>
                           <!-- city type-->
                          <div class="kind">
                              <select id="add_city" name="city" >
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
                           <p class="error" id="Error_city">خطأ كبير يا نجم</p>

                            <!-- user type-->
                            <div class="kind">
                              <select id="add_shop_activity" name="shop_activity" >
                              <option selected disabled value>نشاط المحل</option>
                              <option value="ملابس أطفال">ملابس أطفال</option>
                              <option value="ملابس رجالي">ملابس رجالي</option>
                              <option value="ملابس حريمي">ملابس حريمي</option>
                              <option value="أحذية رجالي">أحذية رجالي</option>
                              <option value="أحذية حريمي">أحذية حريمي</option>
                              <option value="الموبايلات">الموبايلات</option>
                              <option value="إلكترونيات وكمبيوترات">إلكترونيات وكمبيوترات</option>
                              <option value="سوبر ماركت">سوبر ماركت</option>
                              <option value="أقمشة">أقمشة</option>
                              <option value="مطاعم">مطاعم</option>
                              <option value="أجهزة كهربية وإلكترونية">أجهزة كهربية وإلكترونية</option>
                              <option value="العاب أطفال">العاب أطفال</option>
                              <option value="حلويات">حلويات</option>
                              <option value="خضروات وفاكهة">خضروات وفاكهة</option>
                              <option value="مستلزمات رجالي">مستلزمات رجالي</option>
                              <option value="مستلزمات حريمي">مستلزمات حريمي</option>
                              <option value="سجاد ومفروشات">سجاد ومفروشات</option>
                              <option value="سيراميك ومواد صحية">سيراميك ومواد صحية</option>
                              <option value="شركات السفر والسياحة">شركات السفر والسياحة</option>
                              <option value="صيدليات">صيدليات</option>
                              <option value="محلات عطور وبخور">محلات عطور وبخور</option>
                              <option value="مكاتب وأدوات مكتبية">مكاتب وأدوات مكتبية</option>
                              <option value="لحوم حمراء وبيضاء">لحوم حمراء وبيضاء</option>
                              <option value="مغسلة">مغسلة</option>
                              <option value="مقاهي">مقاهي</option>
                              <option value="مواد تنظيف">مواد تنظيف</option>
                              <option value="دهب">دهب</option>
                              <option value="معدات سيارات">معدات سيارات</option>
                              <option value="كوافير حريمي">كوافير حريمي</option>
                              <option value="كوافير رجالي">كوافير رجالي</option>
                              <option value="أتيليه رجالي">أتيليه رجالي</option>
                              <option value="أتيليه حريمي">أتيليه حريمي</option>
                              <option value="العطار">العطار</option>
                              <option value="أدوات كهربية">أدوات كهربية</option>
                              <option value="إستوديوهات وفوتوجرافيك">إستوديوهات وفوتوجرافيك</option>
                              
                                
                            </select> 
                           </div>
                           <p class="error" id="Error_activity">خطأ كبير يا نجم</p>

                            <textarea placeholder="أضف وصفا للمحل..." class="textarea" id="s_desc" name="shop_description"></textarea>
                            <br/><br/>
                            <p class="error" id="Error_shop_description">خطأ كبير يا نجم</p>
                            <h4 class="text-center">حدد مكان المحل</h4>
                            <div class="google_map" id="map"></div>
                            <input type="text" class="inputnumber" id="latitude" name="latitude_name" placeholder="أدخل ال latitude" />
                            <br/><br/>
                            <p class="error" id="Error_lat">خطأ كبير يا نجم</p>
                            <input type="text" class="inputnumber" id="longitude" name="longitude_name" placeholder="أدخل ال longitude" />
                            <br/><br/>
                            <p class="error" id="Error_long">خطأ كبير يا نجم</p>
                            <input type="submit" value="إضافة المحل"  name="login_sub" class="btn_edit_user" />
                                
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
                    <?php if(@$_SESSION['Success_shop_check']=="true"):?>
                        src="../images/icons/accept.png"
                    <?php else:?>
                        src="../images/icons/cancel.png"
                    <?php endif;?>
                    /><b 
                    <?php if(@$_SESSION['Success_shop_check']=="true"):?>
                        style="color:#080"
                    <?php else:?>
                        style="color:#ff0000"
                    <?php endif;?>
                    
                    >&nbsp;&nbsp;<?php echo @$_SESSION['message_shop'];?></b> </h4>
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
        <script src="../javascript/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../javascript/bootstrap.min.js"></script>
        <!-- My plugin js       -->
        <script src="../javascript/jquery.nicescroll.min.js"></script>
        <script src="../javascript/index.js"></script>
    	<script src="../javascript/add_shop.js"></script>
        <!-- start message with error handling -->
        <?php if(@$_SESSION['Success_shop_check']):?>
        <script type="text/javascript">
            $(document).ready(function(){
                 $('#Message').modal('show');
            });
        </script>
        <?php endif;?>
        <?php @$_SESSION['Success_shop_check']=null;?>
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
    
        <!-- start google map script -->
        <script type="text/javascript">
          // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
        </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB78cdec3R-uv8tK88pJPE-sEBP2cWj1NI&callback=initMap"></script>
        <!-- end google map script -->
    </body>
</html>