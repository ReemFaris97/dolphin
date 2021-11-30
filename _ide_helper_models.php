<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAccount
 *
 * @property int $id
 * @property string|null $ar_name
 * @property string|null $en_name
 * @property string|null $kind
 * @property string|null $status
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $account_id
 * @property int|null $active
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $amount
 * @property string|null $closing_account
 * @property int|null $safe_id
 * @property int|null $bank_id
 * @property int|null $cost_center
 * @property string|null $openning_balance
 * @property int|null $asset_id
 * @property string|null $level
 * @property string|null $type
 * @property int|null $client_id
 * @property-read AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|AccountingAccount[] $children
 * @property-read int|null $children_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|AccountingAccount[] $childrenCostCenter
 * @property-read int|null $children_cost_center_count
 * @property-read AccountingAccount|null $parent
 * @property-read AccountingAccount|null $parents
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|static[] all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|static[] get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount treeOf(callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAccountId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereActive($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAmount($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereArName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAssetId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereBankId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereClientId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereClosingAccount($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCode($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCostCenter($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCreatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereEnName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereKind($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereLevel($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereOpenningBalance($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereSafeId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereStatus($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereStoreId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereSupplierId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereType($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereUpdatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class AccountingAccount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAccountLog
 *
 * @property int $id
 * @property int|null $entry_id
 * @property int|null $account_id
 * @property string|null $account_amount_before
 * @property int|null $another_account_id
 * @property string|null $affect
 * @property string|null $amount
 * @property string|null $account_amount_after
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $another_account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountAmountAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountAmountBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereAnotherAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountLog whereUpdatedAt($value)
 */
	class AccountingAccountLog extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAccountSetting
 *
 * @property-read \App\Models\AccountingSystem\AccountingAccount $account
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAccountSetting query()
 */
	class AccountingAccountSetting extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAllowance
 *
 * @property int $id
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereUpdatedAt($value)
 */
	class AccountingAllowance extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAsset
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $currency_id
 * @property string|null $purchase_price
 * @property string|null $purchase_date
 * @property int|null $payment_id
 * @property int|null $account_id
 * @property string|null $damage_start_date
 * @property string|null $damage_end_date
 * @property string|null $damage_type
 * @property string|null $damage_period
 * @property string|null $damage_period_type
 * @property string|null $damage_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingAssetDamageLog[] $AssetLogs
 * @property-read int|null $asset_logs_count
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingCustodyLog[] $custodyLogs
 * @property-read int|null $custody_logs_count
 * @property-read \App\Models\AccountingSystem\AccountingPayment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereDamageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAsset whereUpdatedAt($value)
 */
	class AccountingAsset extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAssetDamageLog
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $asset_id
 * @property string|null $amount
 * @property string|null $amount_asset_after
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAmountAssetAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAssetDamageLog whereUpdatedAt($value)
 */
	class AccountingAssetDamageLog extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingAttendance
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $type
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereUpdatedAt($value)
 */
	class AccountingAttendance extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBank
 *
 * @property int $id
 * @property string $name
 * @property string|null $bank_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $en_name
 * @property string|null $account_name
 * @property string|null $account_num
 * @property int|null $currency_id
 * @property int|null $active
 * @property string|null $notes
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereBankNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBank whereUpdatedAt($value)
 */
	class AccountingBank extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBenod
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $en_description
 * @property string|null $ar_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereUpdatedAt($value)
 */
	class AccountingBenod extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBond
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $store_id
 * @property string|null $bond_num
 * @property string|null $date
 * @property string|null $description
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $total_price
 * @property int|null $store_to
 * @property int|null $store_form
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereBondNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereUserId($value)
 */
	class AccountingBond extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBondProduct
 *
 * @property int $id
 * @property int|null $bond_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $price
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBondProduct whereUpdatedAt($value)
 */
	class AccountingBondProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBonusDiscount
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $type
 * @property string $date
 * @property string $value
 * @property string|null $notes
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereValue($value)
 */
	class AccountingBonusDiscount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBranch
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $email
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $code
 * @property-read \App\Models\AccountingSystem\AccountingCompany $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingBranchFace[] $faces
 * @property-read int|null $faces_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSafe[] $safes
 * @property-read int|null $safes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingStore[] $stores
 * @property-read int|null $stores_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch withoutTrashed()
 */
	class AccountingBranch extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBranchCategory
 *
 * @property int $id
 * @property int $branch_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory withoutTrashed()
 */
	class AccountingBranchCategory extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBranchFace
 *
 * @property int $id
 * @property string $name
 * @property int $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBranch $branch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingFaceColumn[] $columns
 * @property-read int|null $columns_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereUpdatedAt($value)
 */
	class AccountingBranchFace extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingBranchShift
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string $from
 * @property string $to
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBranch $branch
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift withoutTrashed()
 */
	class AccountingBranchShift extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingCenterAccount
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $center_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingCostCenter|null $center
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereUpdatedAt($value)
 */
	class AccountingCenterAccount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingClient
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $fax
 * @property int|null $category
 * @property string|null $tax_number
 * @property string|null $commercial_registration_no
 * @property string|null $type_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $type_bills
 * @property int $credit
 * @property string|null $amount
 * @property string|null $period
 * @property int $taxes_status
 * @property string|null $currency
 * @property int $is_active
 * @property string|null $balance
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCommercialRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTaxesStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTypeBills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereTypePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingClient whereUpdatedAt($value)
 */
	class AccountingClient extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingColumnCell
 *
 * @property int $id
 * @property string $name
 * @property int $column_id
 * @property string $width
 * @property string $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $empty
 * @property-read \App\Models\AccountingSystem\AccountingFaceColumn $column
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereEmpty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereWidth($value)
 */
	class AccountingColumnCell extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingCompany
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $email
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $legal_title
 * @property string|null $another_title
 * @property string|null $license_number
 * @property string|null $street
 * @property string|null $region
 * @property string|null $area
 * @property string|null $postal_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingBranch[] $branches
 * @property-read int|null $branches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingBranchShift[] $shifts
 * @property-read int|null $shifts_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingCompany onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereAnotherTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereLegalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany wherePostalNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCompany whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingCompany withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingCompany withoutTrashed()
 */
	class AccountingCompany extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingCostCenter
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property string|null $kind
 * @property int|null $center_id
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingCostCenter[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereUpdatedAt($value)
 */
	class AccountingCostCenter extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingCurrency
 *
 * @property int $id
 * @property string|null $ar_name
 * @property string|null $en_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereUpdatedAt($value)
 */
	class AccountingCurrency extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingCustodyLog
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $operation_name
 * @property int|null $asset_id
 * @property string|null $amount
 * @property string|null $amount_asset_after
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_id
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAmountAssetAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereOperationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCustodyLog whereUpdatedAt($value)
 */
	class AccountingCustodyLog extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDamage
 *
 * @property int $id
 * @property int|null $store_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingDamageProduct[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamage whereUserId($value)
 */
	class AccountingDamage extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDamageProduct
 *
 * @property int $id
 * @property int|null $damage_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingDamage|null $damage
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereDamageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDamageProduct whereUpdatedAt($value)
 */
	class AccountingDamageProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDebt
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $value
 * @property string|null $reason
 * @property-read int|null $payments_count
 * @property \Illuminate\Support\Carbon|null $pay_from
 * @property string|null $notes
 * @property int $payed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingDebtPayment[] $payments
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePayFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt wherePaymentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebt whereValue($value)
 */
	class AccountingDebt extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDebtPayment
 *
 * @property int $id
 * @property int $debt_id
 * @property string $date
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDebtPayment whereValue($value)
 */
	class AccountingDebtPayment extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDelegate
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereUpdatedAt($value)
 */
	class AccountingDelegate extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDelegateProduct
 *
 * @property int $id
 * @property int|null $delegate_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereDelegateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereUpdatedAt($value)
 */
	class AccountingDelegateProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDevice
 *
 * @property int $id
 * @property int|null $store_id
 * @property string|null $name
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $deleted_at
 * @property int $available
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingMoneyClause $clause
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDevice whereUpdatedAt($value)
 */
	class AccountingDevice extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingDocument
 *
 * @property int $id
 * @property string $documentable_type
 * @property int $documentable_id
 * @property string $document_name
 * @property string $document_number
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string $document
 * @property string $notes
 * @property int $parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $documentable
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereDocumentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDocument whereUpdatedAt($value)
 */
	class AccountingDocument extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingEntry
 *
 * @property int $id
 * @property string|null $date
 * @property string|null $source
 * @property string|null $type
 * @property string|null $code
 * @property string|null $currency
 * @property string|null $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingEntryAccount[] $accounts
 * @property-read int|null $accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntry whereUpdatedAt($value)
 */
	class AccountingEntry extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingEntryAccount
 *
 * @property int $id
 * @property int|null $entry_id
 * @property int|null $account_id
 * @property string|null $affect
 * @property string|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $from_account_id
 * @property int|null $to_account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $from
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $to
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryAccount whereUpdatedAt($value)
 */
	class AccountingEntryAccount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingEntryLog
 *
 * @property int $id
 * @property int|null $entry_id
 * @property string|null $operation
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $account_id
 * @property string|null $debtor
 * @property string|null $creditor
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingEntry|null $entry
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereCreditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereDebtor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingEntryLog whereUserId($value)
 */
	class AccountingEntryLog extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingFaceColumn
 *
 * @property int $id
 * @property string $name
 * @property int $face_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingColumnCell[] $cells
 * @property-read int|null $cells_count
 * @property-read \App\Models\AccountingSystem\AccountingBranchFace $face
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereFaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereUpdatedAt($value)
 */
	class AccountingFaceColumn extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingFiscalPeriod
 *
 * @property int $id
 * @property int|null $year_id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $from
 * @property string|null $to
 * @property string|null $duration
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingFiscalYear|null $year
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalPeriod whereYearId($value)
 */
	class AccountingFiscalPeriod extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingFiscalYear
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $from
 * @property string|null $to
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingFiscalPeriod[] $periods
 * @property-read int|null $periods_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFiscalYear whereUpdatedAt($value)
 */
	class AccountingFiscalYear extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingHoliday
 *
 * @property int $id
 * @property string $name
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereUpdatedAt($value)
 */
	class AccountingHoliday extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingIndustrial
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereUpdatedAt($value)
 */
	class AccountingIndustrial extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingInventory
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $store_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bond_num
 * @property string|null $description
 * @property int|null $cost_type
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereBondNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereCostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventory whereUserId($value)
 */
	class AccountingInventory extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingInventoryProduct
 *
 * @property int $id
 * @property int|null $inventory_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property int|null $Real_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property-read \App\Models\AccountingSystem\AccountingInventory|null $inventory
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereRealQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingInventoryProduct whereUpdatedAt($value)
 */
	class AccountingInventoryProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingItemDiscount
 *
 * @property int $id
 * @property string|null $discount_type
 * @property int|null $discount
 * @property int|null $affect_tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $item_id
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereAffectTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingItemDiscount whereUpdatedAt($value)
 */
	class AccountingItemDiscount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingJobTitle
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereUpdatedAt($value)
 */
	class AccountingJobTitle extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingMoneyClause
 *
 * @property int $id
 * @property string|null $sanad_num
 * @property string $default
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $concerned
 * @property int|null $client_id
 * @property int|null $supplier_id
 * @property int|null $benod_id
 * @property int|null $safe_id
 * @property string|null $amount
 * @property string|null $notes
 * @property \App\Models\AccountingSystem\AccountingPayment|null $payment
 * @property int|null $company_id
 * @property int|null $branch_id
 * @property int|null $user_id
 * @property string|null $num
 * @property int|null $bank_id
 * @property string|null $num_transaction
 * @property string|null $image
 * @property string|null $name
 * @property string|null $date
 * @property string|null $description
 * @property int|null $center_id
 * @property int|null $account_id
 * @property int|null $payment_id
 * @property int|null $revenue_account_id
 * @property-read \App\Models\AccountingSystem\AccountingBank|null $bank
 * @property-read \App\Models\AccountingSystem\AccountingBenod|null $benod
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCostCenter|null $center
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBenodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereConcerned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereNumTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereRevenueAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSanadNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyClause whereUserId($value)
 */
	class AccountingMoneyClause extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingMoneyTransaction
 *
 * @property int $id
 * @property string $amount
 * @property string $model_type
 * @property int $model_id
 * @property int $clause_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingMoneyClause $clause
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingMoneyTransaction whereUpdatedAt($value)
 */
	class AccountingMoneyTransaction extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingNotifiaction
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $package_id
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingNotifiaction whereUpdatedAt($value)
 */
	class AccountingNotifiaction extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingOffer
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $package_id
 * @property string|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingPackage|null $package
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereUpdatedAt($value)
 */
	class AccountingOffer extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPackage
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingOffer[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPackage whereUpdatedAt($value)
 */
	class AccountingPackage extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPayment
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $safe_id
 * @property int|null $bank_id
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBank|null $bank
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPayment whereUpdatedAt($value)
 */
	class AccountingPayment extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPermium
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereUpdatedAt($value)
 */
	class AccountingPermium extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProduct
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property int $is_active
 * @property int|null $category_id
 * @property int|null $cell_id
 * @property array|null $bar_code
 * @property string $main_unit
 * @property string $selling_price
 * @property string $purchasing_price
 * @property string $min_quantity
 * @property string $max_quantity
 * @property string|null $expired_at
 * @property string|null $image
 * @property string|null $size
 * @property string|null $color
 * @property string|null $height
 * @property string|null $width
 * @property int|null $num_days_recession
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $store_id
 * @property int|null $industrial_id
 * @property string|null $unit_price
 * @property string|null $quantity
 * @property string|null $wholesale_price
 * @property int $is_settlement
 * @property string $date_settlement
 * @property int|null $settlement_store_id
 * @property \App\Models\AccountingSystem\AccountingColumnCell|null $cell
 * @property int|null $column_id
 * @property string|null $alert_duration
 * @property int|null $supplier_id
 * @property int|null $account_id
 * @property string|null $en_name
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductBarcode[] $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \App\Models\AccountingSystem\AccountingProductCategory|null $category
 * @property-read \App\Models\AccountingSystem\AccountingColumnCell|null $cell_product
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingProduct[] $components
 * @property-read int|null $components_count
 * @property-read mixed $text
 * @property-read mixed $total_discounts
 * @property-read mixed $total_taxes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSale[] $sold_items
 * @property-read int|null $sold_items_count
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $storeSettlement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingStore[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductSubUnit[] $sub_units
 * @property-read int|null $sub_units_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct ofBarcode($barcode)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereAlertDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereDateSettlement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIndustrialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereIsSettlement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereMinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereNumDaysRecession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct wherePurchasingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSettlementStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereWholesalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProduct whereWidth($value)
 */
	class AccountingProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductBarcode
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $barcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductBarcode whereUpdatedAt($value)
 */
	class AccountingProductBarcode extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductCategory
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $ar_description
 * @property string|null $en_description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $company_id
 * @property-read \App\Models\AccountingSystem\AccountingCompany $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereUpdatedAt($value)
 */
	class AccountingProductCategory extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductComponent
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $name
 * @property string|null $quantity
 * @property string|null $main_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $component_id
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductComponent whereUpdatedAt($value)
 */
	class AccountingProductComponent extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductDiscount
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $discount_type
 * @property string|null $quantity
 * @property string|null $gift_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $percent
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereGiftQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductDiscount whereUpdatedAt($value)
 */
	class AccountingProductDiscount extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductMainUnit
 *
 * @property int $id
 * @property string|null $main_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereUpdatedAt($value)
 */
	class AccountingProductMainUnit extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductOffer
 *
 * @property int $id
 * @property int|null $parent_product_id
 * @property int|null $child_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereChildProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereParentProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductOffer whereUpdatedAt($value)
 */
	class AccountingProductOffer extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductStore
 *
 * @property int $id
 * @property int|null $store_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $quantity
 * @property int|null $bond_id
 * @property int $is_active
 * @property int|null $unit_id
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductStore whereUpdatedAt($value)
 */
	class AccountingProductStore extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductSubUnit
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $name
 * @property string|null $bar_code
 * @property string|null $main_unit_present
 * @property string|null $selling_price
 * @property string|null $purchasing_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $quantity
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereMainUnitPresent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit wherePurchasingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductSubUnit whereUpdatedAt($value)
 */
	class AccountingProductSubUnit extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingProductTax
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $tax
 * @property int|null $price_has_tax
 * @property string|null $tax_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $tax_band_id
 * @property-read \App\Models\AccountingSystem\AccountingTaxBand|null $Taxband
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax wherePriceHasTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTaxBandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductTax whereUpdatedAt($value)
 */
	class AccountingProductTax extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPurchase
 *
 * @property int $id
 * @property string|null $amount
 * @property int|null $discount
 * @property string|null $total
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $debts
 * @property string|null $totalTaxs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bill_num
 * @property int|null $purchase_id
 * @property int|null $safe_id
 * @property int|null $company_id
 * @property int|null $branch_id
 * @property string|null $discount_type
 * @property string|null $bill_date
 * @property int|null $daily_number
 * @property int|null $counter
 * @property string|null $counter_purchase
 * @property int|null $user_id
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingPurchaseItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSafe|null $safe
 * @property-read \App\Models\AccountingSystem\AccountingSession $session
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBillDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCounterPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDailyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDebts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchase whereUserId($value)
 */
	class AccountingPurchase extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPurchaseItem
 *
 * @property int $id
 * @property int|null $purchase_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $unit_id
 * @property string|null $tax
 * @property string|null $price_after_tax
 * @property string|null $unit_type
 * @property string|null $expire_date
 * @property string|null $gifts
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingProductSubUnit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereGifts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseItem whereUpdatedAt($value)
 */
	class AccountingPurchaseItem extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPurchaseReturn
 *
 * @property int $id
 * @property int|null $purchase_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amount
 * @property string|null $discount
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $totalTaxs
 * @property string|null $bill_num
 * @property string|null $discount_type
 * @property string|null $bill_date
 * @property int|null $branch_id
 * @property int|null $safe_id
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingPurchaseReturnItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBillDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereSafeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturn whereUserId($value)
 */
	class AccountingPurchaseReturn extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingPurchaseReturnItem
 *
 * @property int $id
 * @property int|null $purchase_return_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $unit_type
 * @property string|null $price
 * @property string|null $tax
 * @property string|null $price_after_tax
 * @property int|null $unit_id
 * @property string|null $gifts
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereGifts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem wherePurchaseReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPurchaseReturnItem whereUpdatedAt($value)
 */
	class AccountingPurchaseReturnItem extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingReturn
 *
 * @property int $id
 * @property int|null $sale_id
 * @property string|null $discount
 * @property string|null $total
 * @property string|null $bill_num
 * @property string|null $totalTaxs
 * @property string|null $discount_type
 * @property string|null $payment
 * @property int|null $session_id
 * @property int|null $user_id
 * @property int|null $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property string|null $amount
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingReturnSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSession|null $session
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereUserId($value)
 */
	class AccountingReturn extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingReturnSaleItem
 *
 * @property int $id
 * @property int|null $sale_return_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property int|null $unit_id
 * @property string|null $unit_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read AccountingReturnSaleItem|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereSaleReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturnSaleItem whereUpdatedAt($value)
 */
	class AccountingReturnSaleItem extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSafe
 *
 * @property int $id
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string|null $custody
 * @property string|null $name
 * @property int|null $type
 * @property int|null $device_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amount
 * @property string|null $status
 * @property string|null $account_name
 * @property string|null $account_num
 * @property int|null $currency_id
 * @property int|null $active
 * @property string|null $notes
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingCurrency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereCustody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSafe whereUpdatedAt($value)
 */
	class AccountingSafe extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSalary
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $salary
 * @property string $allowance
 * @property string $bonus
 * @property string $discount
 * @property string $date
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereAllowance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereUpdatedAt($value)
 */
	class AccountingSalary extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSale
 *
 * @property int $id
 * @property string|null $amount
 * @property int|null $discount
 * @property string|null $total
 * @property int|null $client_id
 * @property string|null $payment
 * @property string|null $payed
 * @property string|null $debts
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $package_id
 * @property int|null $session_id
 * @property int|null $branch_id
 * @property int|null $company_id
 * @property int|null $store_id
 * @property string|null $bill_num
 * @property string|null $status
 * @property string|null $totalTaxs
 * @property int|null $user_id
 * @property string|null $cash
 * @property string|null $network
 * @property string|null $discount_type
 * @property int|null $daily_number
 * @property int|null $counter
 * @property string|null $counter_sale
 * @property string|null $date
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read mixed $item_cost
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSession|null $session
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCounterSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDailyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDebts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereNetwork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSale whereUserId($value)
 */
	class AccountingSale extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSaleItem
 *
 * @property int $id
 * @property int|null $sale_id
 * @property int|null $product_id
 * @property string|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $unit_id
 * @property string|null $unit_type
 * @property string|null $price_after_tax
 * @property string|null $tax
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingSale|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem wherePriceAfterTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSaleItem whereUpdatedAt($value)
 */
	class AccountingSaleItem extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingService
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $price
 * @property string|null $type
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingService withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingService withoutTrashed()
 */
	class AccountingService extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSession
 *
 * @property int $id
 * @property int|null $device_id
 * @property int|null $shift_id
 * @property int|null $user_id
 * @property string $password
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_session
 * @property string|null $end_session
 * @property string|null $custody
 * @property string|null $status
 * @property-read \App\Models\AccountingSystem\AccountingDevice|null $device
 * @property-read \App\Models\AccountingSystem\AccountingBranchShift|null $shift
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereCustody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereEndSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereShiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereStartSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSession whereUserId($value)
 */
	class AccountingSession extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Setting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $value
 * @property string $page
 * @property string $slug
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereValue($value)
 * @property string|null $accounting_type
 * @property string|null $height
 * @property string|null $display
 * @property string|null $up
 * @property string|null $dawn
 * @property string|null $right
 * @property string|null $left
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereAccountingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereDawn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSetting whereUp($value)
 */
	class AccountingSetting extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSroreRequest
 *
 * @property int $id
 * @property string $status
 * @property string|null $refused_reason
 * @property int|null $user_id
 * @property int|null $store_form
 * @property int|null $store_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $bond_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereBondId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereRefusedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSroreRequest whereUserId($value)
 */
	class AccountingSroreRequest extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingStore
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $address
 * @property string|null $image
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $width
 * @property int $status
 * @property string|null $cost
 * @property string|null $from
 * @property string|null $to
 * @property int $type
 * @property int|null $basic_store_id
 * @property int $is_active
 * @property int|null $user_id
 * @property int|null $account_id
 * @property-read AccountingStore|null $basic
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingStore onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereBasicStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingStore withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingStore withoutTrashed()
 */
	class AccountingStore extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingStoreKeeper
 *
 * @property int $id
 * @property string $phone
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property int|null $store_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStoreKeeper whereUpdatedAt($value)
 */
	class AccountingStoreKeeper extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSupplier
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $branch_id
 * @property int $credit
 * @property string|null $amount
 * @property string|null $period
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $phones
 * @property string|null $password
 * @property string|null $image
 * @property int|null $bank_id
 * @property string|null $bank_account_number
 * @property string|null $tax_number
 * @property int $is_active
 * @property string|null $balance
 * @property int|null $account_id
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSupplierCompany[] $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier wherePhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplier whereUpdatedAt($value)
 */
	class AccountingSupplier extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSupplierCompany
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingCompany|null $company
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierCompany whereUpdatedAt($value)
 */
	class AccountingSupplierCompany extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSupplierLog
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $purchase_id
 * @property int|null $clause_id
 * @property string|null $status
 * @property string|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $new_balance
 * @property string|null $type
 * @property int|null $return_id
 * @property-read \App\Models\AccountingSystem\AccountingMoneyClause|null $clause
 * @property-read \App\Models\AccountingSystem\AccountingPurchase|null $purchase
 * @property-read \App\Models\AccountingSystem\AccountingSupplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereNewBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierLog whereUpdatedAt($value)
 */
	class AccountingSupplierLog extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingSupplierProduct
 *
 * @property int $id
 * @property int|null $supplier_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSupplierProduct whereUpdatedAt($value)
 */
	class AccountingSupplierProduct extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingTaxBand
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $percent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereUpdatedAt($value)
 */
	class AccountingTaxBand extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingTemplate
 *
 * @property int $id
 * @property int|null $first_account_id
 * @property int|null $second_account_id
 * @property string|null $result
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $operation
 * @property int|null $template_id
 * @property string $report_no
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $first_account
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $second_account
 * @property-read AccountingTemplate|null $template
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereFirstAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereReportNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereSecondAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereUpdatedAt($value)
 */
	class AccountingTemplate extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingTransaction
 *
 * @property int $id
 * @property int|null $store_form
 * @property int|null $store_to
 * @property int|null $product_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $cost
 * @property float|null $price
 * @property int|null $request_id
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @property-read \App\Models\AccountingSystem\AccountingSroreRequest|null $request
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransaction whereUpdatedAt($value)
 */
	class AccountingTransaction extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingTransactionSafe
 *
 * @property int $id
 * @property int|null $safe_form_id
 * @property int|null $safe_to_id
 * @property string|null $amount
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string|null $type
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereSafeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereSafeToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTransactionSafe whereUserId($value)
 */
	class AccountingTransactionSafe extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingUserHolidaysBalance
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property int $holiday_id
 * @property int $days
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingHoliday $holiday
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereHolidayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserHolidaysBalance whereUpdatedAt($value)
 */
	class AccountingUserHolidaysBalance extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingUserPermission
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereUserId($value)
 */
	class AccountingUserPermission extends \Eloquent {}
}

namespace App\Models\AccountingSystem{
/**
 * App\Models\AccountingSystem\AccountingUserSalary
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $title_id
 * @property string|null $salary
 * @property string|null $bouns
 * @property string|null $total_salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereBouns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereTotalSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereUserId($value)
 */
	class AccountingUserSalary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminNotification
 *
 * @property int $id
 * @property int $creator_id
 * @property string|null $title
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereUpdatedAt($value)
 */
	class AdminNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AttachedProducts
 *
 * @property int $id
 * @property int $quantity
 * @property string|null $price
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $product_id
 * @property int|null $transaction_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\Store $store
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttachedProducts whereUpdatedAt($value)
 */
	class AttachedProducts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bank
 *
 * @property int $id
 * @property string $name
 * @property string $bank_account_number
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 */
	class Bank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BankDeposit
 *
 * @property int $id
 * @property string|null $deposit_number
 * @property int|null $bank_id
 * @property int $user_id
 * @property string $amount
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property string $deposit_date
 * @property-read \App\Models\Bank|null $bank
 * @property-read \App\Models\User $distributor
 * @property-read \App\Models\DistributorTransaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereDepositNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereUserId($value)
 */
	class BankDeposit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Charge
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $worker_id
 * @property int $supervisor_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $destroyed_at
 * @property string|null $code
 * @property string|null $confirmed_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChargeLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\User $supervisor
 * @property-read \App\Models\User $worker
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereDestroyedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereWorkerId($value)
 */
	class Charge extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChargeLog
 *
 * @property int $id
 * @property int $worker_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $charge_id
 * @property int|null $previous_worker_id
 * @property-read \App\Models\Charge $charge
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User|null $previousWorker
 * @property-read \App\Models\User $worker
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereChargeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog wherePreviousWorkerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeLog whereWorkerId($value)
 */
	class ChargeLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Clause
 *
 * @property int $id
 * @property string $name
 * @property int|null $amount
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property int|null $default_amount
 * @property string|null $blocked_at
 * @property-read mixed $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClauseLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause newQuery()
 * @method static \Illuminate\Database\Query\Builder|Clause onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereDefaultAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clause whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Clause withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Clause withoutTrashed()
 */
	class Clause extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClauseLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $clause_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Clause $clause
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereUserId($value)
 */
	class ClauseLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $store_name
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property int $is_active
 * @property string|null $code
 * @property int|null $route_id
 * @property int|null $user_id
 * @property int|null $client_class_id
 * @property string|null $tax_number
 * @property string|null $notes
 * @property string $payment_type
 * @property-read \App\Models\ClientClass|null $client_class
 * @property-read mixed $is_blocked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TripInventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $receiver_transactions
 * @property-read int|null $receiver_transactions_count
 * @property-read \App\Models\DistributorRoute|null $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $tripsReport
 * @property-read int|null $trips_report_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereClientClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUserId($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientClass
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass active()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClass whereUpdatedAt($value)
 */
	class ClientClass extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientClassProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $client_class_id
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereClientClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientClassProduct whereUpdatedAt($value)
 */
	class ClientClassProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DailyReport
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $cash
 * @property string|null $expenses
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $store_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Store $store
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport filterWithDates($from_date = null, $to_date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport newQuery()
 * @method static \Illuminate\Database\Query\Builder|DailyReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereExpenses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyReport whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|DailyReport withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DailyReport withoutTrashed()
 */
	class DailyReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DiscardProduct
 *
 * @property int $id
 * @property int $discard_id
 * @property int $product_id
 * @property int $quantity
 * @property string $price
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SupplierDiscard $discard
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereDiscardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiscardProduct whereUpdatedAt($value)
 */
	class DiscardProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DistributorCar
 *
 * @property int $id
 * @property string $car_name
 * @property string $car_model
 * @property int $user_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $plate_number
 * @property int $is_active
 * @property-read \App\Models\Store|null $store
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar available()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar query()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereCarName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorCar whereUserId($value)
 */
	class DistributorCar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DistributorRoute
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $is_finished
 * @property int $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $arrange
 * @property int $round
 * @property string|null $received_code
 * @property int $is_available
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TripInventory[] $inventory
 * @property-read int|null $inventory_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $round_trips_reports
 * @property-read int|null $round_trips_reports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTrips[] $trips
 * @property-read int|null $trips_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $trips_reports
 * @property-read int|null $trips_reports_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute query()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereArrange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereReceivedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorRoute whereUserId($value)
 */
	class DistributorRoute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DistributorSale
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorSale query()
 */
	class DistributorSale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DistributorTransaction
 *
 * @property int $id
 * @property string $sender_type
 * @property int $sender_id
 * @property string $receiver_type
 * @property int $receiver_id
 * @property string $amount
 * @property string|null $received_at
 * @property string|null $signature
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $invoice_number
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $receiver
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $sender
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction receiverUser($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction senderUser($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction userTransactions($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction walletOf($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereReceiverType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereSenderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DistributorTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction withoutTrashed()
 */
	class DistributorTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenditureClause
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $expenditure_type_id
 * @property int $is_active
 * @property-read \App\Models\ExpenditureType $type
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereExpenditureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereUpdatedAt($value)
 */
	class ExpenditureClause extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenditureType
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereUpdatedAt($value)
 */
	class ExpenditureType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int $expenditure_clause_id
 * @property int $expenditure_type_id
 * @property int $user_id
 * @property string $date
 * @property string $time
 * @property string $amount
 * @property string|null $image
 * @property string|null $notes
 * @property string|null $reader_name
 * @property string|null $reader_number
 * @property string|null $reader_image
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $reader_id
 * @property string|null $sanad_No
 * @property int $distributor_route_id
 * @property int $round
 * @property int $has_reader
 * @property-read \App\Models\ExpenditureClause $clause
 * @property-read \App\Models\User $distributor
 * @property-read \App\Models\DistributorRoute $distributor_route
 * @property-read mixed $name
 * @property-read \App\Models\Reader|null $reader
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read \App\Models\ExpenditureType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDistributorRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenditureClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenditureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereHasReader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereReaderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereSanadNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUserId($value)
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FcmToken
 *
 * @property int $id
 * @property string $token
 * @property int $user_id
 * @property string $device
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FcmToken whereUserId($value)
 */
	class FcmToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $image
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUserId($value)
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $receiver_id
 * @property string|null $image
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $channel_id
 * @property-read mixed $channel
 * @property-read \App\Models\User $receiver
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Note
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $user_id
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property array $data
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $admin_notification_id
 * @property-read Notification|null $adminNotifications
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAdminNotificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotificationCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereUpdatedAt($value)
 */
	class NotificationCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OfferProduct
 *
 * @property int $id
 * @property int $supplier_offer_id
 * @property int $product_id
 * @property float $price
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereSupplierOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferProduct whereUpdatedAt($value)
 */
	class OfferProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $ar_name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int|null $store_id
 * @property string $quantity_per_unit
 * @property string|null $min_quantity
 * @property string|null $max_quantity
 * @property string $price
 * @property string $type
 * @property string|null $bar_code
 * @property string|null $image
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductBarcode[] $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientClass[] $client_classes
 * @property-read int|null $client_classes_count
 * @property-read mixed $net_price
 * @property-read mixed $tax_amount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierPrice[] $prices
 * @property-read int|null $prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductQuantity[] $quantities
 * @property-read int|null $quantities_count
 * @property-read \App\Models\Store|null $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProductSubUnit[] $sub_units
 * @property-read int|null $sub_units_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantityPerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withClassPrice($class_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withClientPrice($client_id = null)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductQuantity
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $user_id
 * @property int $quantity
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int $is_confirmed
 * @property int|null $store_id
 * @property int|null $store_transfer_request_id
 * @property int|null $trip_report_id
 * @property string|null $image
 * @property int|null $route_trip_id
 * @property int|null $round
 * @property-read \App\Models\User|null $distributor
 * @property-read mixed $movement_type
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Store|null $store
 * @property-read \App\Models\StoreTransferRequest|null $store_transfer_request
 * @property-read \App\Models\RouteTripReport|null $trip_report
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity filterWithDates($from_date = null, $to_date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity filterWithProduct($product_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity filterWithStore($store_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity totalQuantity()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereRouteTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereStoreTransferRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereTripReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductQuantity whereUserId($value)
 */
	class ProductQuantity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reader
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|Reader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereUpdatedAt($value)
 */
	class Reader extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReasonRefuseDistributor
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereUpdatedAt($value)
 */
	class ReasonRefuseDistributor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RouteReport
 *
 * @property int $id
 * @property int $route_id
 * @property string $cash
 * @property string $expenses
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property int $round
 * @property-read mixed $invoice_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\RouteTrips $routetrip
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereExpenses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteReport whereUserId($value)
 */
	class RouteReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RouteTripReport
 *
 * @property int $id
 * @property int $route_trip_id
 * @property int $store_id
 * @property int $round
 * @property string|null $cash
 * @property string|null $visa
 * @property string|null $total_money
 * @property string|null $notes
 * @property int|null $distributor_transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expenses
 * @property \Illuminate\Support\Carbon|null $paid_at
 * @property-read \App\Models\DistributorTransaction|null $distributor_transaction
 * @property-read mixed $invoice_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\TripInventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\RouteTrips $route_trip
 * @property-read \App\Models\Store $store
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport filterDistributor($distributor = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport ofClient($client = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport ofDistributor($distributor = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport ofMonth($month = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport ofYear($year = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereDistributorTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereExpenses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereRouteTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereTotalMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport whereVisa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTripReport withProductsPrice()
 */
	class RouteTripReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RouteTrips
 *
 * @property int $id
 * @property int $route_id
 * @property int $client_id
 * @property string $lat
 * @property string $lng
 * @property string $address
 * @property int $arrange
 * @property string $status
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $cash
 * @property int $round
 * @property-read \App\Models\TripInventory|null $LastInventory
 * @property-read \App\Models\Client $client
 * @property-read void $is_last_report_has_images
 * @property-read mixed $total
 * @property-read mixed $total_inventories_in_round
 * @property-read mixed $total_reports_in_round
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\TripInventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTripReport[] $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\DistributorRoute $route
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips ofDistributor($distributor)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips orderByDistance($lat, $lng)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips query()
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereArrange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RouteTrips whereUpdatedAt($value)
 */
	class RouteTrips extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SmsCode
 *
 * @property int $id
 * @property string $code
 * @property string $receivable_type
 * @property int $receivable_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereReceivableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereReceivableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereUpdatedAt($value)
 */
	class SmsCode extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Store
 *
 * @property int $id
 * @property array $name
 * @property int|null $store_category_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $distributor_id
 * @property string|null $notes
 * @property int $is_active
 * @property int $for_distributor
 * @property int|null $has_car
 * @property int|null $car_id
 * @property int $for_damaged
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductQuantity[] $ProductQuantity
 * @property-read int|null $product_quantity_count
 * @property-read \App\Models\DistributorCar|null $car
 * @property-read \App\Models\StoreCategory|null $category
 * @property-read \App\Models\User|null $distributor
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Store active()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store ofDistributor($distributor_id)
 * @method static \Illuminate\Database\Query\Builder|Store onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDistributorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereForDamaged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereForDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereHasCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereStoreCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Store withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Store withoutTrashed()
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoreCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $blocked_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|StoreCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StoreCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StoreCategory withoutTrashed()
 */
	class StoreCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoreTransferRequest
 *
 * @property int $id
 * @property int|null $sender_id
 * @property int|null $distributor_id
 * @property int $is_confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $sender_store_id
 * @property int|null $distributor_store_id
 * @property string|null $signature
 * @property-read \App\Models\User|null $distributor
 * @property-read \App\Models\Store|null $distributor_store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductQuantity[] $productQuantities
 * @property-read int|null $product_quantities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Store $receiver_store
 * @property-read \App\Models\User|null $sender
 * @property-read \App\Models\Store|null $sender_store
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|StoreTransferRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereDistributorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereDistributorStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereSenderStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreTransferRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StoreTransferRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StoreTransferRequest withoutTrashed()
 */
	class StoreTransferRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierBill
 *
 * @property int $id
 * @property int $user_id
 * @property string $bill_number
 * @property string $date
 * @property int $supplier_id
 * @property string $payment_method
 * @property string $vat
 * @property string $amount_paid
 * @property string $amount_rest
 * @property string|null $transfer_date
 * @property string|null $transfer_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bank_name
 * @property string|null $check_number
 * @property string|null $check_date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierBillProduct[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $supplier
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereAmountRest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereBillNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCheckDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCheckNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereTransferDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereTransferNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBill whereVat($value)
 */
	class SupplierBill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierBillProduct
 *
 * @property int $id
 * @property int $supplier_bill_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\SupplierBill $supplier_bill
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereSupplierBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierBillProduct whereUpdatedAt($value)
 */
	class SupplierBillProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierDiscard
 *
 * @property int $id
 * @property int $user_id
 * @property int $supplier_id
 * @property string $reason
 * @property string $return_type
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DiscardProduct[] $discard_products
 * @property-read int|null $discard_products_count
 * @property-read \App\Models\User $supplier
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard newQuery()
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard withoutTrashed()
 */
	class SupplierDiscard extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierLog whereUserId($value)
 */
	class SupplierLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierOffer
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferProduct[] $offer_products
 * @property-read int|null $offer_products_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer newQuery()
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer withoutTrashed()
 */
	class SupplierOffer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierPrice
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expired_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierPrice whereUserId($value)
 */
	class SupplierPrice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierTransaction
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $amount
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierTransaction whereUpdatedAt($value)
 */
	class SupplierTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $date
 * @property string|null $time_from
 * @property string|null $equation_mark
 * @property string|null $rate
 * @property string|null $period
 * @property int|null $after_task_id
 * @property int|null $clause_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clause_amount
 * @property int|null $finished_by
 * @property int $user_id
 * @property-read Task|null $afterTask
 * @property-read \App\Models\Clause|null $clause
 * @property-read \App\Models\User $creator
 * @property-read mixed $date_with_time
 * @property-read mixed $is_finished
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskUser[] $task_users
 * @property-read int|null $task_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskLog[] $task_users_logs
 * @property-read int|null $task_users_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskUser[] $user_tasks
 * @property-read int|null $user_tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Task finished($user = null, $mark = '!=', $date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task future($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task mine($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task old($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Task present($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task toFinish($user_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task toRate($user_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereAfterTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereClauseAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereEquationMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereFinishedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskLog
 *
 * @property int $id
 * @property int $old_user_id
 * @property int $new_user_id
 * @property int $task_id
 * @property string|null $notes
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $new_user
 * @property-read \App\Models\User $old_user
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereNewUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereOldUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdatedAt($value)
 */
	class TaskLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskUser
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $finisher_id
 * @property int|null $rater_id
 * @property string $task_duration
 * @property \Illuminate\Support\Carbon|null $finished_at
 * @property \Illuminate\Support\Carbon|null $rated_at
 * @property int|null $rate
 * @property string|null $comment
 * @property string|null $worker_finished_at
 * @property-read \App\Models\User|null $finisher
 * @property-read mixed $can_finish
 * @property-read mixed $days
 * @property-read mixed $duration_array
 * @property-read mixed $duration
 * @property-read mixed $finishing_rate
 * @property-read mixed $from_time
 * @property-read mixed $full_date
 * @property-read mixed $hours
 * @property-read mixed $minutes
 * @property-read mixed $rest_time
 * @property-read mixed $status
 * @property-read mixed $to_time
 * @property-read mixed $total_duration
 * @property-read \App\Models\User|null $rater
 * @property-read \App\Models\Task $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser fromTimeDuration()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser notFinished()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser ofUser($user_id, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereFinisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereRatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereRaterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereTaskDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser whereWorkerFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskUser withTotalDuration()
 */
	class TaskUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TripInventory
 *
 * @property int $id
 * @property int $trip_id
 * @property string $type
 * @property string|null $notes
 * @property string|null $refuse_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $round
 * @property-read mixed $product_items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read TripInventory $previous_trip_inventory
 * @property-read \App\Models\RouteTripReport $previous_trip_report
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttachedProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\RouteTrips $trip
 * @property-read \App\Models\RouteTripReport|null $trip_report
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory filterDistributor($distributor = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory filterRoute($route = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory filterWithDates($from_date = null, $to_date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory ofDistributor($distributor = null)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereRefuseReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereRouteId($route_id)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory withPreviousTripInventory()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory withPreviousTripReport()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory withReportProducts()
 * @method static \Illuminate\Database\Eloquent\Builder|TripInventory withTripClientAndRoute()
 */
	class TripInventory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $image
 * @property string|null $job
 * @property string|null $nationality
 * @property string|null $company_name
 * @property string|null $blocked_at
 * @property int $is_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property int $is_distributor
 * @property int $is_supplier
 * @property string $supplier_type
 * @property string|null $tax_number
 * @property string|null $lat
 * @property string|null $lng
 * @property int $is_verified
 * @property int|null $verification_code
 * @property int|null $parent_user_id
 * @property int|null $bank_id
 * @property string|null $bank_account_number
 * @property string|null $distributor_status
 * @property string|null $settle_commission
 * @property string|null $sell_commission
 * @property string|null $reword_value
 * @property int|null $store_id
 * @property int $is_storekeeper
 * @property int|null $accounting_store_id
 * @property int $is_saler
 * @property int|null $is_accountant
 * @property int|null $delete_product
 * @property int|null $role_id
 * @property string|null $hiring_date
 * @property string|null $salary
 * @property int|null $title_id
 * @property int $enable
 * @property int|null $target
 * @property string|null $affiliate
 * @property string|null $address
 * @property string|null $notes
 * @property string|null $ordering_coin
 * @property int $car_id
 * @property string $holiday_balance
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $accounting_store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingAllowance[] $allowances
 * @property-read int|null $allowances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingAttendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\Bank|null $bank
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingBonusDiscount[] $bonus_discount
 * @property-read int|null $bonus_discount_count
 * @property-read \App\Models\Store $car_store
 * @property-read \App\Models\Store|null $damaged_store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingDebt[] $debts
 * @property-read int|null $debts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $distributor_transactions
 * @property-read int|null $distributor_transactions_count
 * @property-read mixed $fcm_token_android
 * @property-read mixed $fcm_token_ios
 * @property-read mixed $fcm_token_web
 * @property-read mixed $last_location
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingHoliday[] $holidays
 * @property-read int|null $holidays_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Spatie\Permission\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorRoute[] $routes
 * @property-read int|null $routes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSalary[] $salaries
 * @property-read int|null $salaries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Charge[] $supervisor_charge
 * @property-read int|null $supervisor_charge_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierBill[] $supplierBills
 * @property-read int|null $supplier_bills_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierLog[] $supplierLog
 * @property-read int|null $supplier_log_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $supplier_staff
 * @property-read int|null $supplier_staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierTransaction[] $supplier_transactions
 * @property-read int|null $supplier_transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskUser[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \App\Models\AccountingSystem\AccountingJobTitle|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FcmToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RouteTrips[] $trips
 * @property-read int|null $trips_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Charge[] $user_charge
 * @property-read int|null $user_charge_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User ofClient($client_id)
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User searchByName()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountingStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAffiliate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeleteProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistributorStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHiringDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHolidayBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAccountant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSaler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsStorekeeper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrderingCoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereParentUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRewordValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSellCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSettleCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSupplierType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerificationCode($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
/**
 * App\Models\UserPermission
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission query()
 */
	class UserPermission extends \Eloquent {}
}

