# webshell_test

### Simple webshells :
 - bourrin.php (*very noisy*)
 - system.php (*quite similar, poc of system() cmd*)
 - eval.php (*using eval() function*)

### Backdoor with encrypted tunneling

 - backdoor.php(*the actual backdoor*)
 - bd_payload_generator.php (*to generate the payload to send*)

To use it, you have to run the backdoor on the server, then forge the payload as you like by editing the payload generator
To run the payload :
```bash
curl -X POST -d "your_encoded_pyload" http://IP_SERVER/backdoor.php
```
