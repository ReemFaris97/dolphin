
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/vendors/base/new-print-sales.css') }}">
<style>
.header, .header-space {
    height: 138px;
}
</style>
<div class="m-portlet__body">
    <button type="button" id="print-all">طباعة</button>
    <!--------- start content ---------->
    <div id="print_this">
        <div id="myDivToPrint">
            <div class="logo-bg">
                <div class="bill-container">
                    <div>
                        <!--- header -->
                        <div class="header">
                            <header>
                                <div class="hd_inn">
                                    <div class="hd_txt">
                                        <h3>مؤسسة دلفن التجارية</h3>
                                        <h3>Dolphin Trading Corporation</h3>
                                        <div class="flexx">
                                        </div>
                                    </div>
                                    <div class="logo">
                                            <img src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}"
                                                alt="logo">
                                        </div>

                                </div>
                            </header>
                            <!---- columns -->
                            <div class="row">
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>اسم المورد</h4>
                                            <p>99</p>
                                            <!-- <h4>date</h4> -->
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>رقم الفاتورة لدي المورد</h4>
                                            <p> 5</p>
                                          
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>رقم الفاتورة</h4>
                                            <p>16904 </p>
                                            <h4>invoice no.</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="row">
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>التاريخ</h4>
                                            <p>11‏/1‏/2022, 12:02:35 م</p>
                                            <h4>date</h4>
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>نوع الفاتورة</h4>
                                            <p>فاتورة نقدية</p>
                                            <h4>invoice type</h4>
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4> عدد الاصناف</h4>
                                            <p>16904 </p>
                                            <h4>invoice no.</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="row">
                                <div class="box1">
                                    <div class="flexx">
                                        <div class="box1 half">
                                            <div class="flexx">
                                                <h4>مدخل الفاتوره</h4>
                                                <p>سليمان صالح </p>
                                                <h4>Representative Name</h4>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                                                                                                <!--- table---->

                        <table>
                            <thead><tr><td>
                              <div class="header-space">&nbsp;</div>
                            </td></tr></thead>
                            <tbody><tr><td>
                              <div class="content">
                                <div class="bg_logo">
                                    <table dir="ltr" class="the_table">
                                        <thead>
                                        <tr>
                                           
                                            <th>
                                                <p>م</p>
                                            </th>
                                            <th>
                                                <p>إسم الصنف</p>
                                            </th>
                                            <th>
                                                <p>الوحدة</p>
                                            </th>
                                            <th>
                                                <p>الكمية</p>
                                            </th>
                                            <th>
                                                <p>سعر الوحدة</p>
                                            </th>
                                            <th>
                                                <p>الضريبة للوحدة </p>
                                            </th>
                                            <th>
                                                <p>الهدايا </p>
                                            </th>
                                            <th>
                                                <p>الخصومات </p>
                                            </th>
                                            <th>
                                                <p>ضريبة القيمة المضافة </p>
                                            </th>
                                           
                                            <th class="col9">
                                                <p> اجمالي السعر </p>
                                            </th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="product-name">حب دوار شمس محمص مالح</td>
                                                <td> جرام </td>
                                                <td>502</td>
                                                <td>0.02</td>
                                                <td> 0</td>
                                                <td>10.04</td>
                                                <td>10.04</td>
                                                <td>10.04</td>
                                                <td>10.04</td>
                                            </tr>
                                         
                                                                                                            
                                         </tbody>
                                    </table>
                                </div>
                              </div>
                            </td></tr></tbody>
                            <tfoot><tr><td>
                              <div class="footer-space">&nbsp;</div>
                            </td></tr></tfoot>
                          </table>

                    </div>
                    <div class="footer">
                        <div class="">
                            <table class="the_table">
                                <tfoot>
                                <tr>
                                    <th>67.8609</th>
                                    <th colspan="4">
                                        <div class="flexx">
                                            <p>total</p>
                                            <p>الإجمالى (بدون ضريبة)</p>
                                        </div>
                                    </th>
                          

                                </tr>
                                <tr>
                                    <th>10.1791</th>
                                    <th colspan="4">
                                        <div class="flexx">
                                            <p>قيمة القيمة المضافة</p>
                                            <p>vat (15%)</p>
                                        </div>

                                    </th>
                                </tr>
                                <tr>
                                    <th>78.04</th>
                                    <th >
                                        <p>net amount</p>
                                        <p>اجمالى الفاتورة</p>
                                    </th>

                                    <th >
                                        <div class="box1">
                                            <div class="flexx">
                                                <h4>المبلغ كتابة:</h4>
                                                <h4>S.R in words:</h4>
                                            </div>
                                            
                                            <p>
                                                فقط ثمانية و سبعون ريال وأربعة هللات لا غير
                                            </p>
                                        </div>
                                    </th>

                                </tr>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-3 box1 flexx" style="width:100%">
                                    <p style="text-align:center;">المدفوع كاش</p>
                                    <p style="text-align:center;">0</p>
                                </div>
                               
                            </div>
                        </div>
                        <!--- footer -->
                        <footer>

                            <!-- <div class="row">
                                <div class="flexx foot_bg">
                                    <div>
                                        <h5>المملكة العربية السعودية - القصيم - بريدة - شارع الصباخ
                                        </h5>
                                        <div class="sp-arrownd">
                                            <h5>الهاتف</h5>
                                            <h5>0163231301</h5>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <h5>الرقم الضريبى vat no.</h5>
                                        <h5>300420708200003</h5>
                                        <h5>سجل تجارى c.r</h5>
                                        <h5>1131021506</h5>
                                    </div>
                                    <div>
                                        <h5> Kingdom of Saudi Arabia - Al-Qassim - Qassim Second Industrial City</h5>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://beta.alqabedah.com/dashboard/assets/vendors/base/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#print-all").on('click', function () {
            window.print();

            // let t = document.getElementById("print_this").innerHTML;
            // let style = ``;
            // let win = window.open('', '');
            // win.document.write(`${style}${t}`);
            // win.document.close();
            // setTimeout(() => {win.print()}, 100);
        });
        // window.print();

    })
</script>
