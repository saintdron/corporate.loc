@extends(env('THEME') . '.layouts.site')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="content-page" class="content group">
        <div class="hentry group">
            <form id="contact-form-contact-us" class="contact-form" method="post" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <ul>
                        <li class="text-field">
                            <label for="name-contact-us">
                                <span class="label">Login</span>
                                <br/> <span class="sublabel">This is a field login</span><br/>
                            </label>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" name="login" id="login-contact-us" class="required"
                                       value="{{ old('login') }}"/>
                            </div>
                        </li>
                        <li class="text-field">
                            <label for="email-contact-us">
                                <span class="label">Password</span>
                                <br/> <span class="sublabel">This is a field password</span><br/>
                            </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span>
                                <input type="password" name="password" id="password-contact-us" class="required"
                                       value=""/>
                            </div>
                        </li>
                        <li class="submit-button">
                            <input type="submit" name="submit" value="Войти" class="sendmail alignright"/>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
@endsection