package com.example.SOAP;

import javax.jws.WebMethod;
import javax.jws.WebService;
import java.util.ArrayList;
import java.util.Date;

@WebService
public interface ReservationInterface {
    @WebMethod
    public void setReservationChambre(Chambre chambre, Date dateArrivee, Date dateDepart);

    @WebMethod
    public String getChambreToString();

    @WebMethod
    public ArrayList getChambresArray();
}
