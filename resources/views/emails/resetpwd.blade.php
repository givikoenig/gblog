@component('mail::message')
# ПрювеД!

Lorem ipsum dolor sit amet, [ somelink ]({{ route('home') }}) consectetur adipisicing elit. Fugiat alias ad cupiditate id tenetur asperiores aliquid rem libero nam incidunt sequi quaerat nisi est nemo voluptatibus sit quisquam aut, veniam.
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iusto, assumenda at placeat, voluptas cum sapiente hic neque eius ipsam a rerum deleniti nam earum temporibus sint omnis tenetur totam.

@component('mail::button', ['url' => ''])
Тут кноПка
@endcomponent

Мерси,<br>
{{ config('app.name') }}
@endcomponent
