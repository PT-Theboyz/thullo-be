<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Assign New Board Mail</title>
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
                    <p>We are excited to invite you to join our Kanban board! This board is designed to help us organize and manage our tasks and projects more efficiently. By using this board, we will be able to see the progress of our tasks in real-time and make adjustments as needed.</p>
                    <p>To access the board, please click on the link below:</p>
                    <p><a href="{{env('FE_URL')}}/b/{{$boardId}}">Access Kanban Board : {{$boardName}}</a></p>
                    <p>Once you have access, you will be able to add tasks, move them through different stages of completion, and collaborate with your team members. We encourage you to take some time to familiarize yourself with the board and its features.</p>
                    <p>If you have any questions or need assistance, please feel free to reach out to us. We are always happy to help.</p>
                    <p>Best,<br>
                    Pertatask Team</p>
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
