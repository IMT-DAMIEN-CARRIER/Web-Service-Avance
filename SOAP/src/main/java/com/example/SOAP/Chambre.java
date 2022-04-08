package com.example.SOAP;

import javax.jws.WebService;
import java.util.ArrayList;
import java.util.Date;

@WebService
    public class Chambre implements ReservationInterface{
    private int idChambre;
    private String typeChambre;
    private double prix;
    private boolean etat;
    private String dateA;
    private String dateD;
    static ArrayList<Chambre> list = new ArrayList();

    public Chambre() {}

    public Chambre(int idChambre, String typeChambre, double prix) {
        this.idChambre = idChambre;
        this.typeChambre = typeChambre;
        this.prix = prix;
        this.etat = true;
        this.dateA = "";
        this.dateD = "";
    }

    @Override
    public void setReservationChambre(Chambre chambre, Date dateArrivee, Date dateDepart) {

    }

    @Override
    public String getChambreToString() {
        String listeChambre = "";

        for (Chambre chambre : getChambresArray()) {
            if (chambre.isEtat()) {
                listeChambre += "La chambre numéro : " + chambre.getIdChambre() + " est disponible.\n\r";
            } else {
                listeChambre += "La chambre numéro : " + chambre.getIdChambre() + " n'est pas disponible.\n\r";
            }
        }

        return listeChambre;
    }

    @Override
    public ArrayList<Chambre> getChambresArray() {
        return list;
    }

    public int getIdChambre() {
        return idChambre;
    }

    public void setIdChambre(int idChambre) {
        this.idChambre = idChambre;
    }

    public String getTypeChambre() {
        return typeChambre;
    }

    public void setTypeChambre(String typeChambre) {
        this.typeChambre = typeChambre;
    }

    public double getPrix() {
        return prix;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public boolean isEtat() {
        return etat;
    }

    public void setEtat(boolean etat) {
        this.etat = etat;
    }

    public String getDateA() {
        return dateA;
    }

    public void setDateA(String dateA) {
        this.dateA = dateA;
    }

    public String getDateD() {
        return dateD;
    }

    public void setDateD(String dateD) {
        this.dateD = dateD;
    }
}
