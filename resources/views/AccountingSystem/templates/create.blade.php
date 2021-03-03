@extends('AccountingSystem.layouts.master')
@section('title','إنشاء تقرير  جديد')
@section('parent_title','إدارة  التقارير المالية')
@section('action', URL::route('accounting.templates.index'))

@section('styles')
    <style>
        .row_account {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة تقرير جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        {!!Form::open( ['route' => 'accounting.templates.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'x-data'=>'reportTemplate()']) !!}
        <div class="form-group col-sm-3 col-xs-3 pull-left ">
            <label>  اسم التقرير </label>
            <input type="text" name="report_no" class="form-control" >
        </div>
        <div class="clearfix"></div>
        <table>
            <tbody class="accounts">

            <template x-for="(child,i) in range" :key="i">
                <tr>
                    <td>
                        <div class="form-group col-sm-3 col-xs-3 pull-left ">
                            <label> البند الاول </label>
                            <select key="first_account_id" class="form-control js-example-basic-single" :name="`Nodes[${i}][first_account_id]`"
                                    @change="updateChildren($event,i)">
                                <option value="x" x-text="parent.result"></option>
                                <template x-for="(account,index) in level_accounts(i)" :key="index">
                                    <option :value="account.id" x-text="account.ar_name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group col-sm-1 col-xs-1 pull-left ">
                            <label> العملية</label>

                            <select  class="form-control" key="operation" :name="`Nodes[${i}][operation]`"
                                    @change="updateChildren($event,i)">

                                <option value="+" >+</option>
                                <option value="-" >-</option>
                                <option value="*" >*</option>
                                <option value="/" >/</option>
                            </select>


                        </div>
                        <div class="form-group col-sm-3 col-xs-3 pull-left ">
                            <label> البند الثانى </label>

                            <select key="first_account_id" class="form-control js-example-basic-single" :name="`Nodes[${i}][second_account_id]`"
                                    @change="updateChildren($event,i)">
                                <option value="x" x-text="parent.result"></option>
                                <template x-for="(account,index) in level_accounts(i)" :key="index">
                                    <option :value="account.id" x-text="account.ar_name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group col-sm-1 col-xs-1 pull-left ">
                            <label></label>
                            <h1>=</h1>
                        </div>
                        <div class="form-group col-sm-3 col-xs-3 pull-left ">
                            <label> ادخل اسم البند المحصل</label>
                            <input type="text" :name="`Nodes[${i}][result]`" key="result" class="form-control result"
                                   @change="updateChildren($event,i)">
                        </div>
                    </td>
                    <td>
                        <div class="form-group col-sm-3 col-xs-3 pull-left"
                             x-show="i===(children_number-1)">
                            <button type="button" @click="children_number=children_number+1" class="btn btn-success ">+
                                <i class="icon-arrow-left13 position-right"></i></button>
                        </div>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
        <div class="text-center col-md-12 ">
            <div class="text-right">
                <button type="submit" id="register" class="btn btn-success">حفظ <i
                        class="icon-arrow-left13 position-right"></i></button>
            </div>
        </div>
        {!!Form::close() !!}
    </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script>
        function reportTemplate() {
            return {
                result: null,
                accounts:@json($accounts) ,
                parent: {
                    first_account_id: "",
                    operation: null,
                    second_account_id: null,
                    result: null,

                },
                get range() {
                    for (let i = 0; i < this.children_number; i++) {
                        if (this.children.length < this.children_number) {
                            this.children.push({...this.parent});
                        }
                    }
                    return this.children;
                },
                level_accounts(level) {
                    var generic_accounts = [];

                    let arr = JSON.parse(JSON.stringify(this.children));

                    arr.splice(level - arr.length)

                    arr.forEach(function (value, key) {

                        generic_accounts.push({
                            id: `x-${key}`,
                            ar_name: value.result,
                        })
                    });

                    return [...generic_accounts, ...(JSON.parse(JSON.stringify(this.accounts)))]
                },
                children_number: 1,
                children: [],
                updateChildren(e, key) {
                    this.children[key][e.target.getAttribute('key')] = e.target.value;
                }


            }

        }

    </script>


    <script>
        $(document).ready(function () {
            var num = 1;

            var accounts = <?php echo json_encode($accounts); ?>;

            {{--            $("#add-new" + num).on('click', append)--}}

            {{--            function append() {--}}
            {{--                num = num + 1;--}}
            {{--                console.log(num);--}}
            {{--                console.log(accounts);--}}
            {{--                var optss = ``;--}}
            {{--                Object.keys(accounts).forEach(function (key) {--}}
            {{--                    optss += '<option  value="' + key + '" > ' + accounts[key] + '</option> ';--}}
            {{--                });--}}

            {{--                $(".accounts").append(`--}}
            {{--<tr>--}}
            {{--<td>--}}
            {{--         <div class="form-group col-sm-3 col-xs-3 pull-left ">--}}
            {{--                         <label>  اختر  البند الاول </label>--}}
            {{--                <select class="form-control js-example-basic-single" name="first_account_id[${num}]" >--}}
            {{--									${optss}--}}
            {{--								</select>--}}
            {{--               </div>--}}
            {{--                 <div class="form-group col-sm-1 col-xs-1 pull-left ">--}}
            {{--                           <label>  اختر العملية</label>--}}
            {{--{!! Form::select("operation[]",['+'=>'+','-'=>'-','*'=>'*','/'=>'/'],null,['class'=>'form-control'])!!}--}}
            {{--                </div>--}}
            {{--                <div class="form-group col-sm-3 col-xs-3 pull-left ">--}}
            {{--                    <label>  اختر  البند الثانى </label>--}}
            {{--            <select class="form-control js-example-basic-single" name="second_account_id[${num}]" >--}}
            {{--									${optss}--}}
            {{--								</select>--}}
            {{--                </div>--}}

            {{--                <div class="form-group col-sm-1 col-xs-1 pull-left ">--}}
            {{--                    <label> </label>--}}
            {{--                    <h1>=</h1>--}}
            {{--                </div>--}}
            {{--                <div class="form-group col-sm-3 col-xs-3 pull-left ">--}}
            {{--                    <label>   ادخل اسم البند المحصل</label>--}}
            {{--                    <input type="text" name="result[]" class="form-control result"/>--}}
            {{--                </div>--}}
            {{--                </td>--}}
            {{--                 <td>--}}
            {{--                      <div class="form-group col-sm-3 col-xs-3 pull-left ">--}}
            {{--                           <button type="button" class="btn btn-success add-new" id="add-new${num}" >+ <i--}}
            {{--                                    class="icon-arrow-left13 position-right"></i></button>--}}
            {{--                        </div>--}}
            {{--                    </td>--}}
            {{--</tr>--}}
            {{--`);--}}
            {{--                $("#add-new" + num).on('click', append)--}}
            {{--                $(this).prop("disabled", true);--}}
            {{--                var result = $('.result').val();--}}
            {{--                console.log(result);--}}

            {{--                accounts['x'] = result;--}}
            {{--                console.log(accounts);--}}
            {{--                var result = $('.result').val();--}}
            {{--                accounts.push(result);--}}
            {{--            }--}}
        });


    </script>
@endsection
