<form method="post" action="{{ $action }}">
    <input type="hidden" name="ac_account_email" value="{{ $ac_account_email }}" />
    <input type="hidden" name="ac_sci_name" value="{{ $ac_sci_name }}" />
    <input type="text" name="ac_amount" value="{{ $ac_amount }}" />
    <input type="text" name="ac_currency" value="{{ $ac_currency }}" />
    <input type="hidden" name="ac_order_id" value="{{ $ac_order_id }}" />
    <input type="hidden" name="ac_sign" value="{{ $ac_sign }}" />
    <!-- Optional Fields -->
    <input type="hidden" name="ac_success_url" value="{{ $ac_success_url }}" />
    <input type="hidden" name="ac_success_url_method" value="POST" />
    <input type="hidden" name="ac_fail_url" value="{{ $ac_fail_url }}" />
    <input type="hidden" name="ac_fail_url_method" value="POST" />
    <input type="hidden" name="ac_status_url" value="{{ $ac_status_url }}" />
    <input type="hidden" name="ac_status_url_method" value="POST" />
    @if($comment !== '') <input type="hidden" name="ac_comments" value="{{ $comment }}" /> @endif
    <input type="hidden" name="ident" value="{{ $ident }}">
    <button type="submit" >{{ __("Отправить") }}</button>
</form>
