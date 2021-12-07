<!DOCTYPE html>
<!-- saved from url=(0064)#demo/vuexy-mail-template/mail-welcome.html -->
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <!--[if mso]>
    <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    <style>
      td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
  <![endif]-->
    <title>Notifikasi Inrasff 👋</title>
    {{-- <link href="./Notifikasi Inrasff 👋_files/css" rel="stylesheet" media="screen"> --}}
    <link href="{{asset('backadmin/mail/css')}}" rel="stylesheet" media="screen">
    <style>
      .hover-underline:hover {
        text-decoration: underline !important;
      }

      @keyframes spin {
        to {
          transform: rotate(360deg);
        }
      }

      @keyframes ping {

        75%,
        100% {
          transform: scale(2);
          opacity: 0;
        }
      }

      @keyframes pulse {
        50% {
          opacity: .5;
        }
      }

      @keyframes bounce {

        0%,
        100% {
          transform: translateY(-25%);
          animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
        }

        50% {
          transform: none;
          animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
      }

      @media (max-width: 600px) {
        .sm-leading-32 {
          line-height: 32px !important;
        }

        .sm-px-24 {
          padding-left: 24px !important;
          padding-right: 24px !important;
        }

        .sm-py-32 {
          padding-top: 32px !important;
          padding-bottom: 32px !important;
        }

        .sm-w-full {
          width: 100% !important;
        }
      }
    </style>
  <style type="text/css">.fc-ab-root { display: none !important } body > div.fc-ab-root { display: none !important } .fbs-auth__container.fbs-auth__adblock { display: none !important } .overlay-34_Kj { display: none !important } .wrapper-3AzfF { display: none !important } .fEy1Z2XT { display: none !important } .nytc---modal-window---windowContainer.nytc---modal-window---isShown.nytc---shared---blackBG { display: none !important } .tp-modal { display: none !important } .tp-backdrop.tp-active { display: none !important } .c-nudge__container.c-gate__container { display: none !important } .c-nudge__container.c-regGate__container { display: none !important } .css-n7r8pg { display: none !important } .css-1bd8bfl { display: none !important } .overlay__59af11e2 { display: none !important } .tp_modal { display: none !important } .tp-backdrop.tp-active { display: none !important } div[class^='sp_message_container'] { display: none !important } div[class^='sp_veil'] { display: none !important } </style></head>

  <body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; --bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity));">
    <div style="display: none;">INRASFF</div>
    <div role="article" aria-roledescription="email" aria-label="Notifikasi Inrasff 👋" lang="en">
      <table style="font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tbody><tr>
          <td align="center" style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif;" bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
            <table class="sm-w-full" style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; width: 600px;" width="600" cellpadding="0" cellspacing="0" role="presentation">
              <tbody><tr>
                <td class="sm-py-32 sm-px-24" style="font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif; padding: 48px; text-align: center;" align="center">
                  <a style="text-decoration: none" href="{{route('home')}}">
                    {{-- <img src="{{asset('backadmin/mail/logo.png')}}" width="155" alt="Vuexy Admin" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;"> --}}
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                  </a>
                </td>
              </tr>
              <tr>
                <td align="center" class="sm-px-24" style="font-family: &#39;Montserrat&#39;,Arial,sans-serif;">
                  <table style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tbody><tr>
                      <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                        <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Halo</p>
                        <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #ff5850; color: rgba(255, 88, 80, var(--text-opacity));">{{ $user->responsible_name }}!</p>
                        
                        <p style="margin: 24px 0;">
                          <span style="font-weight: 600;">Anda</span>
                          telah ditunjuk untuk menindaklanjuti notifikasi <b>{{ $downstream->number }}</b> pada {{ \Carbon\Carbon::make($downstream->created_at)->isoFormat('dddd, D MMM Y') }}.
                        </p>
                        <p style="font-weight: 500; font-size: 16px; margin-bottom: 0;">Apa yang harus dilakukan sekarang?</p>
                        <ul style="margin-bottom: 24px;">
                          <li>
                            Silahkan mengunjungi 🚀 <a style="text-decoration: none" href="{{route('backadmin.dashboard')}}" target="_blank">Website Inrasff</a> .
                          </li>
                          <li>
                            Buka Halaman Downstream lalu cari notifikasi dengan kode  <b>{{ $downstream->number }}</b>
                          </li>
                          <li>
                            Masuk ke menu 8. Tindak Lanjut. Lakukan Tindak Lanjut sesuai prosedur.
                          </li>
                        </ul>
                        <table style="font-family: &#39;Montserrat&#39;,Arial,sans-serif;" cellpadding="0" cellspacing="0" role="presentation">
                          <tbody>
                              <tr>
                            <td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0; background-color: rgba(115, 103, 240, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
                              <a target="_blank" href="{{route('backadmin.dashboard')}}" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; color: rgba(255, 255, 255, var(--text-opacity)); text-decoration: none;">Browse INRASFF →</a>
                            </td>
                          </tr>
                        </tbody></table>
                        <table style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                          <tbody><tr>
                            <td style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; padding-top: 32px; padding-bottom: 32px;">
                              <div style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); height: 1px; line-height: 1px;">‌</div>
                            </td>
                          </tr>
                        </tbody></table>
                        <p style="margin: 0 0 16px;">
                          Ada pertanyaan tentang email? Silahkan
                          <a href="mailto:support@example.com" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">tanya kami</a>.
                        </p>
                        <p style="margin: 0 0 16px;">Terimakasih, <br>Tim INRASFF</p>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; height: 20px;" height="20"></td>
                    </tr>
                    <tr>
                      <td style="font-family: Montserrat, -apple-system, &#39;Segoe UI&#39;, sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
                        <p align="center" style="cursor: default; margin-bottom: 16px;">
                          <a href="#" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{asset('backadmin/mail/facebook.png')}}" width="17" alt="Facebook" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                          •
                          <a href="#" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{asset('backadmin/mail/twitter.png')}}" width="17" alt="Twitter" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                          •
                          <a href="#" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="{{asset('backadmin/mail/instagram.png')}}" width="17" alt="Instagram" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;"></a>
                        </p>
                        <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
                          Use of our service and website is subject to our
                          <a href="#" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Terms of Use</a> and
                          <a href="#" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Privacy Policy</a>.
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-family: &#39;Montserrat&#39;,Arial,sans-serif; height: 16px;" height="16"></td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>
    </div>
  

</body></html>