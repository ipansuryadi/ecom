{{config('label')->click_here_to_reset_your_password}}: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

<!-- Click here to reset your password: {{ url('/password/reset/' .$token) }}-->