package com.example.SOAP;

import javax.xml.ws.Endpoint;

public class Main {
    public static void main(String[] args) {

        Chambre chambre1 = new Chambre(1, "bas de gamme", 10);
        Chambre chambre2 = new Chambre(2, "basique", 20);
        Chambre chambre3 = new Chambre(3, "moyenne gamme", 30);
        Chambre chambre4 = new Chambre(4, "haut de gamme", 50);
        Chambre chambre5 = new Chambre(5, "penthouse", 100);
        chambre1.getChambresArray().add(chambre1);
        chambre1.getChambresArray().add(chambre2);
        chambre1.getChambresArray().add(chambre3);
        chambre1.getChambresArray().add(chambre4);
        chambre1.getChambresArray().add(chambre5);


        Endpoint ep = Endpoint.create(chambre1);

        ep.publish("http://localhost:10000/reservation");

        //Do something

        //Comment below line if service is meant to be running always
//        ep.stop();
    }
}