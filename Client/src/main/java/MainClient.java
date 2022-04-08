import com.example.soap.*;

public class MainClient {

    public static void main(String[] args){
        Chambre chambreService = (new ChambreService()).getChambrePort();


        System.out.println("test de run du ws depuis le client - " + chambreService.getChambreToString());

    }




}