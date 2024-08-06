<!doctype html>
<html lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>{{ __(gs()->site_name) }} - {{ __('Demo Access Granted') }}</title>
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Montserrat:wght@700&family=Lato:wght@700&family=Oswald:wght@700&family=Raleway:wght@700&family=Poppins:wght@700&family=Playfair+Display:wght@700&family=Bebas+Neue&family=Anton&family=Nunito:wght@700&display=swap">
	</head>
	<body style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400;">
	
	<!-- Hero Start -->
        <div style="margin-top: 50px;">
            <table cellpadding="0" cellspacing="0" style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">
                <thead>
                    <tr style="background-color: #2f55d4; padding: 3px 0; line-height: 68px; text-align: center; color: #fff; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                        <th scope="col"><img src="{{ asset('storage/general/'.gs()->logo) }}" height="24" alt="logo"></th>
                    </tr>
                </thead>

                <tbody>
                	<tr>
                        <td style="padding: 48px 24px 0; color: #161c2d; font-size: 18px; font-weight: 600;">
                            Dear, {{ __($data->fullname) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 15px 24px 15px; color: #8492a6;">
                            {{ __($message) }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                            © <script>document.write(new Date().getFullYear())</script> {{ __(gs()->site_name) }}.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Hero End -->
	
	</body>
</html>