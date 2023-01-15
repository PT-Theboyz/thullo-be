<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Assign New Task Mail</title>
  </head>
  <body class="">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="header">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="align-center">
                  <a href="{{env('FE_URL')}}"><img src="https://www.pertamina.com/Media/Image/Pertamina.png" height="50" alt="Postdrop"></a>
                </td>
              </tr>
            </table>
          </div>
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <p>Dear {{$name}},</p>
                    <p>We are pleased to inform you that you have been assigned a new task. Please find the details of the task below:</p>
                    <p>Task Name: <b>{{$taskName}}</b></p>
                    <p>Task Description: <b>{{$taskDesc}}</b></p>
                    <p>Due Date: <b>{{$taskDate}}</b></p>
                    <p>Please take the necessary actions to complete this task on or before the due date. If you have any questions or concerns, please do not hesitate to reach out to us.</p>
                    <p>Thank you for your cooperation.</p>
                    <p>Best,</p>
                    <p>Pertatask Team</p>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">

                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="{{env('FE_URL')}}">Pertatask App</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
