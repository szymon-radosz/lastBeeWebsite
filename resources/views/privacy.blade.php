@extends('layouts.app')

@section('content')
<div class="container homePageContainer pageContainer">
    <div class="row justify-content-center">
        

        @if(Session::get('country') == 'PL')
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>Polityka prywatności</h1>
            </div>
            <div class="col-sm-10 offset-1">
                <p>Bardzo szanujemy Twoje dane, a jednocześnie dbamy o jakość skierowanych do Ciebie informacji. Poniżej prezentujemy w jaki sposób korzystamy z przekazanych nam danych.</p><br />

                <h4>Maile</h4>
                <p>Adresy mailowe są niezbędne do ponownego zalogowania się do serwisu oraz okazjonalnych wiadomości. Aktualnie wykorzystujemy serwis Mailchimp do dostarczania wiadomości, serwis ten posiada własną politykę prywatności.</p><br />

                <h4>Media społecznościowe</h4>
                <p>Możesz zarejestrować się uzywająć zewnętrzych serwisów, e.g. Facebook, Google. 
                Facebook lub Google (nazwane "Mediami społecznościowymi"). Możemy poprosić Cię o potwierdzenie toższamości przy rejestracji przy pomocy Mediów społecznościowych. Da nam to dostęp do niezbędnych informacji do założenia konta. Dane będę przechowane zgodnie z naszą polityką prywatności. </p>

                <h4>Cookies</h4>
                <p>Obecnie używamy Cookies do:</p>
                <p>1. Google Analytics – wykorzystany do poprawy serwowanych przez nasz serwis danych ze względu na lokalizację użytkownika.</p>
                <br />
                <p><strong>Jeśli masz dodatkowe pytania - napisz do nas na adres ask@last-bee.com</strong></p>
                <p><strong>Pozdrowienia,<br /> zespół Last Bee</strong></p><br />
            </div>
        @else
            <div class="col-sm-10 offset-1 pageHeaderTitle">
                <h1>Privacy Policy</h1>
            </div>
            <div class="col-sm-10 offset-1">
                <p>Here’s what is we collect from our users and how it is being used.</p><br />

                <h4>Emails</h4>
                <p>We collect emails for use with occasional messages. We do not rent or sell our email list.
                We currently use Mailchimp to deliver the emails. Mailchimp has its own policy on emails.</p><br />

                <h4>Social networks and logins</h4>
                <p>You may allow access to the Services or log in to them through the Internet services of third parties, such as social media and social networks, e.g. Facebook or Google (referred to as "Social Networks"). We may ask you to confirm your identity in order to use these functions and capabilities, register or log in to Social Networks on the websites of their respective operators. As part of this integration, Social Networks will allow us access to specific information that you have provided to them, and we will use such information, we will store and disclose it in accordance with our Privacy Policy. Please note that the manner in which Third Party Services, including Social Networks, use, store and disclose information about you is governed solely by the policies of these third parties and that we are not responsible for privacy practices or other activities related to any site Internet or external service, which may be activated as part of the provision of Services. In addition, we are not responsible for the accuracy, availability or reliability of any information, content, goods, data, opinions, advice or statements made available in connection with the Social Networking Services. Therefore, we are not liable for any damages or losses due to or allegedly caused by or in connection with the use of any such Services or social networking services.</p>

                <h4>Cookies</h4>
                <p>At the moment, the following can set a cookie on your computer to track usage:</p>
                <p>1. Google Analytics – is what we use to know how many visitors come to our site and how they interact with the site.</p>
                <br />
                <p><strong>If you have further questions, please send us an email message on ask@last-bee.com</strong></p>
                <p><strong>Best wishes,<br /> Last Bee Team</strong></p><br />
            </div>
        @endif 

    </div>
</div>
@endsection
