<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">

    <center>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td align="center" style="padding: 20px 0;">
                    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                        
                        <tr>
                            <td style="background-color: #f76b00; padding: 20px 30px; color: #ffffff;">
                                <h1 style="margin: 0; font-size: 24px; font-weight: bold;">
                                    🔔 New Contact Form Submission
                                </h1>
                                <p style="margin: 5px 0 0; font-size: 14px;">A customer has reached out via the website contact form.</p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 30px; line-height: 1.6;">

                                <p style="font-size: 16px; color: #333333; margin-top: 0; margin-bottom: 25px;">
                                    You have received a new message from a visitor on your website. Please review the details below.
                                </p>

                                <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 25px;">
                                    <tr>
                                        <td style="padding: 8px 0; width: 30%; color: #333; font-weight: bold;"><span style="color: #f76b00;">👤 Name:</span></td>
                                        <td style="padding: 8px 0; color: #333;">{{ $data['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #333; font-weight: bold;"><span style="color: #f76b00;">📧 Email:</span></td>
                                        <td style="padding: 8px 0;"><a href="mailto:{{ $data['email'] }}" style="color: #f76b00; text-decoration: none;">{{ $data['email'] }}</a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #333; font-weight: bold;"><span style="color: #f76b00;">💡 Subject:</span></td>
                                        <td style="padding: 8px 0; color: #333;">{{ $data['subject'] }}</td>
                                    </tr>
                                </table>

                                <p style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #f76b00;">Message:</p>
                                
                                <div style="background-color: #fff9f4; padding: 15px; border-left: 4px solid #f76b00; border-radius: 4px; color: #333333; font-size: 15px;">
                                    {{ $data['message'] }}
                                </div>
                                
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color: #eeeeee; padding: 15px 30px; text-align: center; font-size: 12px; color: #777777;">
                                <p style="margin: 0;">This is an automated notification from your website.</p>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>