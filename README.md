# Prueba práctica de ingreso a WayniMóvil-BCRA



#### INTRODUCCIÓN

AcontinuaciónsedetallaunaevaluacióndeconocimientotécnicadelacompañíaWayniMóvil,
enlacualsebuscaconocerlashabilidadestécnicasdelfuturocolaboradordelacompañía.Se
evalúaprincipalmentelafinalizacióndelaactividad,luegoeldesarrolloysoluciónpropuestay
finalmente,eltiempotranscurrido parasufinalización.

#### DETALLE

SeentregaunamuestradeunarchivoTXT,querepresentaunextractodelarchivooriginaldel
BancoCentral delaRepúblicaArgentinadellistadodeDeudores,quedatadelperiodoJunio
del2017. También, seentrega un documento de especificación enPDF que determina el
formatodelarchivoTXTmencionado anteriormente.

Sepideleereldocumentodeespecificaciónparapoderidentificarlascolumnasnecesarias
parael desarrollodelasoluciónpropuesta.

SepideeldiseñoydesarrollodeunasoluciónquepermitaimportarelarchivoTXTaunabase
dedatosno relacional,mismapuedeserMongodb,DynamoDB,FirebaseCloudFirestoreo
Firebase Realtime Database. La construcción de la solución debe estar codificada en
cualquieradelos siguienteslenguajesde programación:NodeJs, PHP(FrameworkLaravel),
PythonoGo.

Eldiseñodelregistroaimportardebetenerlasiguienteestructura:

**Deudores**

- Nrodeidentificación(CUIT/CUIL-CampoNro.4)–FormatoNumérico.
- Situaciónmás desfavorable(Elnúmeromásalto delcampo Nro.6)–Formato
    Numérico.
- SumadePréstamos(LasumaagrupadadepréstamoscampoNro.7)–Formato
    Numérico.

**Entidad**

- Códigodeentidad(CampoNro.1)–FormatoNumérico.
- Sumadepréstamos(CampoNro.7)–FormatoNumérico.

#### ACLARACIONES

Elarchivodeejemplosoloposeeunaúnicaentidadqueeslaquellevaelcódigo7.Conlo
cual,latabla“Instituciones”contaráconunúnicoregistro.

Encambio,latabladeudorescuentacon 1000 registrosdiferentes,nohayrepetidos,perola
solucióndeberíaconsiderarlasumadelcampopréstamoyelnúmeromásaltodesituaciónen
elcasoqueserepita.Enestecasonohayrepetidos,peroelarchivopuedevenirconrepetidos


conelmismonúmerode identificación,conotraentidadyconotrasituación.


# Intalacion

Tecnologias utilizadas: PHP Laravel y MongoDB 

Dependecias para deploy: Docker

```bash
mkdir wayni_chall
cd wayni_chall
git clone https://github.com/lvlal2iano/wayni_chall.git .

docker compose up -d
``` 

Una vez terminado se podra acceder al endpoint: http://localhost:8000/api/addfile

curl --location 'http://localhost:8000/api/addfile' --form 'file=@"BASEPATH/wayny_chall/deudores.txt"'

se podra ver los datos en 
# Aclaraciones de alcance:
No genere muchas validaciones porque se hiba de foco del objetivo no obstante si deje los ambitos de validacion bien definidos.

No valide el reingreso de data repetida, por lo que se agregaran todos los datos denuevo cada vez que se ejecuto.

Saludos!