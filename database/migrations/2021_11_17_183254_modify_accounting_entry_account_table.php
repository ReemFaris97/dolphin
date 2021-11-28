<?php

use App\Models\AccountingSystem\AccountingAccount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAccountingEntryAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_entries_accounts', function (Blueprint $table) {
<<<<<<< HEAD
            // $table->dropForeign('accounting_entries_accounts_account_id_foreign');
            // $table->dropColumn('account_id');
            // $table->unsignedBigInteger('from_account_id')->nullable();
            // $table->unsignedBigInteger('to_account_id')->nullable();
            // $table->foreign('from_account_id')->references('id')->on('accounting_accounts')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->foreign('to_account_id')->references('id')->on('accounting_accounts')->cascadeOnUpdate()->cascadeOnDelete();
=======
//            $table->dropForeign('accounting_entries_accounts_account_id_foreign');
//            $table->dropColumn('account_id');
//            $table->unsignedBigInteger('from_account_id')->nullable();
//            $table->unsignedBigInteger('to_account_id')->nullable();
//            $table->foreign('from_account_id')->references('id')->on('accounting_accounts')->cascadeOnUpdate()->cascadeOnDelete();
//            $table->foreign('to_account_id')->references('id')->on('accounting_accounts')->cascadeOnUpdate()->cascadeOnDelete();
>>>>>>> 3f350ec7aacf0b1ffb3022db07dbff6a744d5f07
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_entries_accounts', function (Blueprint $table) {
            $table->dropForeign('accounting_entries_accounts_from_account_id_foreign');
            $table->dropForeign('accounting_entries_accounts_to_account_id_foreign');
            $table->dropColumn(['from_account_id','to_account_id']);
            $table->foreignIdFor(AccountingAccount::class, 'account_id')->nullable()->after('entry_id')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
}
