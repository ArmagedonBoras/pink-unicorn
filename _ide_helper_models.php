<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $slug
 * @property int $pinned
 * @property string $gate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereGate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePinned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTrashed()
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $parent_type
 * @property string $title
 * @property string $body
 * @property string $type
 * @property bool $pinned
 * @property \Illuminate\Support\Carbon $expire_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @method static \Illuminate\Database\Eloquent\Builder|Comment filter(\App\Filters\CommentFilters $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePinned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment withoutTrashed()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property \App\Models\User|null $owned_by
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon $starts_at
 * @property \Illuminate\Support\Carbon $ends_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $title
 * @property string $slug
 * @property string|null $body
 * @property int|null $visibility
 * @property int|null $scope
 * @property int|null $availability
 * @property int|null $activity
 * @property int|null $activity_type
 * @property int $has_signup
 * @property int $is_recurring
 * @property int $signup_seats
 * @property string|null $recurring_default_at
 * @property string|null $recurring_year
 * @property string|null $recurring_month
 * @property string|null $recurring_day
 * @property string|null $recurring_week
 * @property string|null $recurring_week_of_month
 * @property string|null $recurring_weekday
 * @property string|null $recurring_end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventOrganizer> $event_organizers
 * @property-read int|null $event_organizers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventSignup> $event_signups
 * @property-read int|null $event_signups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Room> $rooms
 * @property-read int|null $rooms_count
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereActivityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereHasSignup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsRecurring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOwnedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringDefaultAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringWeekOfMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringWeekday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRecurringYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereScope($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSignupSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVisibility($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventOrganizer
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventOrganizer whereUserId($value)
 */
	class EventOrganizer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventSignup
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int|null $role
 * @property int $checked_in
 * @property int|null $payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereCheckedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventSignup whereUserId($value)
 */
	class EventSignup extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxAccount
 *
 * @property int $id
 * @property int $number key in fortnox
 * @property int $active
 * @property string $description
 * @property int $year
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxAccount whereYear($value)
 */
	class FortnoxAccount extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxArticle
 *
 * @property int $id
 * @property string $article_number key in fortnox
 * @property string|null $description
 * @property string|null $sales_price
 * @property int|null $active
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereArticleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereSalesPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxArticle whereUpdatedAt($value)
 */
	class FortnoxArticle extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxCostCenter
 *
 * @property int $id
 * @property string $code key in fortnox
 * @property string $description
 * @property int $active
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCostCenter whereUpdatedAt($value)
 */
	class FortnoxCostCenter extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxCustomer
 *
 * @property int $id
 * @property string|null $customer_number key in fortnox
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $zip_code
 * @property string|null $city
 * @property string|null $email
 * @property string|null $email_invoice
 * @property string|null $email_invoice_c_c
 * @property string|null $country
 * @property string|null $country_code
 * @property string|null $currency
 * @property string $name
 * @property string|null $your_reference
 * @property string|null $organisation_number
 * @property string|null $phone1
 * @property string|null $phone2
 * @property string|null $price_list
 * @property string|null $terms_of_payment
 * @property int $show_price_v_a_t_included
 * @property string $default_delivery_types
 * @property string|null $v_a_t_type
 * @property string|null $v_a_t_number
 * @property string $type
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $email_invoice_cc
 * @property mixed $vat_number
 * @property mixed $vat_type
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereCustomerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereDefaultDeliveryTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereEmailInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereEmailInvoiceCC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereOrganisationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer wherePriceList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereShowPriceVATIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereTermsOfPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereVATNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereVATType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereYourReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxCustomer whereZipCode($value)
 */
	class FortnoxCustomer extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxFinancialYear
 *
 * @property int $fortnox_id model key due to id is the key in fortnox
 * @property int $id key in fortnox
 * @property string $from_date
 * @property string $to_date
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereFortnoxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxFinancialYear whereUpdatedAt($value)
 */
	class FortnoxFinancialYear extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxInvoice
 *
 * @property int $id
 * @property int|null $document_number key in fortnox
 * @property string $customer_number
 * @property string|null $customer_name
 * @property string|null $balance
 * @property int|null $cancelled
 * @property int|null $credit
 * @property string|null $payment_way
 * @property string $invoice_type
 * @property string|null $due_date
 * @property string|null $invoice_date
 * @property string $print_template
 * @property string|null $total
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $row_class
 * @property-read mixed $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Fortnox\FortnoxInvoiceRow> $rows
 * @property-read int|null $rows_count
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereCustomerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereInvoiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice wherePaymentWay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice wherePrintTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoice whereUpdatedAt($value)
 */
	class FortnoxInvoice extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxInvoiceRow
 *
 * @property int $id
 * @property int $fortnox_invoice_id
 * @property string $article_number
 * @property string|null $cost_center
 * @property string $delivered_quantity
 * @property string|null $description
 * @property string|null $price
 * @property string|null $unit
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Fortnox\FortnoxInvoice|null $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereArticleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereDeliveredQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereFortnoxInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxInvoiceRow whereUpdatedAt($value)
 */
	class FortnoxInvoiceRow extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxModel query()
 */
	class FortnoxModel extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxVoucher
 *
 * @property int $id
 * @property int|null $voucher_number key in fortnox
 * @property string|null $cost_center
 * @property string|null $description
 * @property string|null $voucher_series
 * @property int|null $year
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Fortnox\FortnoxVoucherRow> $rows
 * @property-read int|null $rows_count
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereVoucherNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereVoucherSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucher whereYear($value)
 */
	class FortnoxVoucher extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxVoucherRow
 *
 * @property int $id
 * @property int $fortnox_voucher_id
 * @property string $account
 * @property string|null $cost_center
 * @property string|null $credit
 * @property string|null $debit
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Fortnox\FortnoxVoucher|null $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereCostCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereDebit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereFortnoxVoucherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherRow whereUpdatedAt($value)
 */
	class FortnoxVoucherRow extends \Eloquent {}
}

namespace App\Models\Fortnox{
/**
 * App\Models\Fortnox\FortnoxVoucherSeries
 *
 * @property int $id
 * @property string $code key in fortnox
 * @property string|null $description
 * @property int $manual
 * @property int $year
 * @property string|null $synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries query()
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FortnoxVoucherSeries whereYear($value)
 */
	class FortnoxVoucherSeries extends \Eloquent {}
}

namespace App\Models\Gamification{
/**
 * App\Models\Gamification\Achievement
 *
 * @property int $id
 * @property int $user_id
 * @property int $point_id
 * @property int $awarded_by
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereAwardedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement wherePointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUserId($value)
 */
	class Achievement extends \Eloquent {}
}

namespace App\Models\Gamification{
/**
 * App\Models\Gamification\Badge
 *
 * @property int $id
 * @property string $name
 * @property int $point
 * @property int $limited
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereLimited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereUpdatedAt($value)
 */
	class Badge extends \Eloquent {}
}

namespace App\Models\Gamification{
/**
 * App\Models\Gamification\Point
 *
 * @property int $id
 * @property string $name
 * @property int $point
 * @property int $limited
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point query()
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereLimited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereUpdatedAt($value)
 */
	class Point extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Key
 *
 * @property int $id
 * @property string $number
 * @property int $hold_by
 * @property int $tag_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Key newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Key newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Key query()
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereHoldBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereUpdatedBy($value)
 */
	class Key extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Link
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property string $icon
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Link whereUrl($value)
 */
	class Link extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Locker
 *
 * @property int $id
 * @property int $number
 * @property int $size
 * @property int|null $user_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Locker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Locker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Locker query()
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locker whereUserId($value)
 */
	class Locker extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $link
 * @property string $gate
 * @property int $sort_order
 * @property string $parent
 * @property int|null $page_id
 * @property int $divider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_link
 * @property-read mixed $gate_options
 * @property-read mixed $parent_options
 * @property-read \App\Models\Page|null $page
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDivider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereGate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OauthProvider
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthProvider whereUserId($value)
 */
	class OauthProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $title
 * @property string|null $title_color
 * @property string|null $tagline
 * @property string|null $tagline_color
 * @property string|null $title_image
 * @property int $title_size
 * @property string|null $body
 * @property bool $active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @property-read mixed $active_options
 * @property-read mixed $active_text
 * @property-read mixed $gate
 * @property-read mixed $link
 * @property-read \App\Models\Menu|null $menu
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTaglineColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitleColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitleImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitleSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedBy($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property string $payable_type
 * @property int $payable_id
 * @property int $amount
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $member_no
 * @property string|null $address
 * @property string|null $zip
 * @property string|null $city
 * @property string|null $person_id
 * @property string|null $phone
 * @property int $paid_year
 * @property int $yearly_fee
 * @property string $supporting
 * @property string $female
 * @property string $bsk
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFemale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMemberNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePaidYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSupporting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereYearlyFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereZip($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Room
 *
 * @property int $id
 * @property int $maintained_by
 * @property string $name
 * @property string $short
 * @property string $icon
 * @property string $color
 * @property string $text_color
 * @property string $description
 * @property int $bookable
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereBookable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereMaintainedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedBy($value)
 */
	class Room extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string|null $label
 * @property string $type
 * @property bool $protected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tag filter(\App\Filters\TagFilters $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereProtected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $member_no
 * @property string $person_id
 * @property int|null $profile_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $login_at
 * @property string|null $last_login_at
 * @property int $points
 * @property int $all_time_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Gamification\Achievement> $achievements
 * @property-read int|null $achievements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Gamification\Achievement> $awarded_by
 * @property-read int|null $awarded_by_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OauthProvider> $oauth_providers
 * @property-read int|null $oauth_providers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAllTimePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaitingList
 *
 * @property int $id
 * @property int $user_id
 * @property int $waiting_list_object_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingList whereWaitingListObjectId($value)
 */
	class WaitingList extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaitingListObject
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaitingListObject whereUpdatedAt($value)
 */
	class WaitingListObject extends \Eloquent {}
}

