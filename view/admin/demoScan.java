
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            Toast.makeText(this, "Vous avez cliqué sur paramètres", Toast.LENGTH_LONG).show();
        }
        else
            if(id == R.id.action_camera) {
                this.prendreUnePhoto();
            }
            else
                if(id == R.id.action_scan) {
                    this.scannerUnDocument();
                }

        return super.onOptionsItemSelected(item);
    }

    private void scannerUnDocument() {
        // lire le manifest pour obtenir la valeur de la permission CAMERA
        int verifPermission = ContextCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.CAMERA);
        // Tester cette permission
        if(verifPermission== PackageManager.PERMISSION_GRANTED) {
            IntentIntegrator intentIntegrator = new IntentIntegrator(this);
            intentIntegrator.setDesiredBarcodeFormats(IntentIntegrator.ALL_CODE_TYPES);
            intentIntegrator.setPrompt("Scannez le QR Code");
            intentIntegrator.setCameraId(0);
            intentIntegrator.setBeepEnabled(false);
            intentIntegrator.setBarcodeImageEnabled(false);
            intentIntegrator.initiateScan();
            //return true;
        }
        else
        {   // l'application demandera l'aurotisation à l'utilisateur si elle est refusée par défaut
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA}, 1313);;
        }
    }

    private void prendreUnePhoto() {
        // lire le manifest pour obtenir la valeur de la permission CAMERA
        int verifPermission = ContextCompat.checkSelfPermission(getApplicationContext(), Manifest.permission.CAMERA);
        // Tester cette permission
        if(verifPermission== PackageManager.PERMISSION_GRANTED) {
            // création d'une intent pour la caméra
            Intent photo = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
            startActivityForResult(photo, 1313);
        }
        else
        {   // l'application demandera l'aurotisation à l'utilisateur si elle est refusée par défaut
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA}, 1313);;
        }
    }

    @Override
    public boolean onSupportNavigateUp() {
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment_content_main);
        return NavigationUI.navigateUp(navController, appBarConfiguration)
                || super.onSupportNavigateUp();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        setContentView(R.layout.fragment_first);
        //setContentView(R.layout.activity_main);
        if(requestCode == 1313) {
            Bitmap bmPhoto = (Bitmap) data.getExtras().get("data");
            if(bmPhoto==null) {
                Toast.makeText(this, "Pas de photo", Toast.LENGTH_LONG).show();
            }
            else{
                ImageView img = (ImageView)  findViewById(R.id.imgPhoto);
                img.setImageBitmap(bmPhoto);
                //ImageView img2 = (ImageView)  findViewById(R.id.imgPhotoMain);
                //img2.setImageBitmap(bmPhoto);;
            }
        }
        else
        {
            setContentView(R.layout.fragment_second);
            IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
            if(result!=null) {
                if(result.getContents()==null){
                    Toast.makeText(this,"How dare you ?!", Toast.LENGTH_SHORT).show();
                }
                else {
                    TextView resultat = (TextView) findViewById(R.id.textview_second);
                    resultat.setText(result.getContents());
                    String res = (String) resultat.getText();
                    if(res.startsWith("http")) {
                        Uri uri = Uri.parse(result.getContents());
                        Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                        startActivity(intent);
                    }
                }
            }
        }

    }