  var exec = require('child_process').exec;
  let text = "sdsd"
  execShellCommand(text)

  function execShellCommand(text) {
      return new Promise((resolve, reject) => {
          // exec(cmd, (error, stdout, stderr) => {
          //     if (error) {
          //         console.warn(error);
          //     }
          //     resolve(stdout ? stdout : stderr);
          // });

          let command = exec('gammu --sendsms TEXT 082113222883 -text "' + text + '"');
          //   command.stdout.on('data', function (data) {
          //       console.log('->' + data);
          //   });

          command.on('exit', code => {
              console.log(`Exit code is: ${code}`);
              resolve(code)
          });
      });
  }
