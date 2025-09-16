<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hearing Impaired AI</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
      background: linear-gradient(135deg, #74ebd5, #9face6);
      color: #333;
      padding: 40px;
    }
    h1 {
      font-size: 2.2rem;
      margin-bottom: 30px;
      color: #222;
    }
    button {
      font-size: 22px;
      padding: 15px 35px;
      cursor: pointer;
      border: none;
      border-radius: 50px;
      background: #4CAF50;
      color: white;
      font-weight: bold;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      transition: 0.3s;
    }
    button:hover {
      background: #45a049;
      transform: scale(1.05);
    }
    #status {
      margin-top: 25px;
      font-size: 1.2rem;
      color: #444;
    }
    #gifDisplay {
      margin-top: 30px;
      display: flex;
      justify-content: center;
    }
    #gifDisplay img {
      max-width: 350px;
      border-radius: 15px;
      box-shadow: 0px 6px 15px rgba(0,0,0,0.3);
      transition: 0.3s;
    }
    #gifDisplay img:hover {
      transform: scale(1.05);
    }
    #gifDisplay p {
      font-size: 1.3rem;
      color: #b00020;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>🎤 ระบบแสดงภาษามือจากเสียง</h1>
  <button onclick="startRecognition()">🎤 กดเพื่อพูด</button>
  <p id="status">กดปุ่มแล้วพูดคำที่ต้องการ...</p>
  <div id="gifDisplay"></div>

<script>
function startRecognition() {
  const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
  recognition.lang = 'th-TH';
  recognition.start();

  recognition.onresult = function(event) {
    const transcript = event.results[0][0].transcript;
    document.getElementById("status").innerText = "คุณพูดว่า: " + transcript;

    fetch("fetch.php?text=" + encodeURIComponent(transcript))
      .then(res => res.json())
      .then(data => {
        if (data.found) {
          document.getElementById("gifDisplay").innerHTML =
            `<img src="${data.path}" alt="${data.name}">`;
        } else {
          document.getElementById("gifDisplay").innerHTML =
            "<p>❌ ไม่พบ GIF ที่ตรงกับคำนี้</p>";
        }
      })
      .catch(() => {
        document.getElementById("status").innerText = "❌ เกิดข้อผิดพลาดในการเชื่อมต่อ";
      });
  };

  recognition.onerror = function(event) {
    document.getElementById("status").innerText = "❌ เกิดข้อผิดพลาด: " + event.error;
  };
}
</script>
</body>
</html>
