#include <stdio.h> 
#include <sys/socket.h> 
#include <arpa/inet.h> 
#include <unistd.h> 
#include <string.h> 
#define PORT 8080 

int main(int argc, char const *argv[]) 
{ 
	int sock = 0, valread; 
	struct sockaddr_in serv_addr; 
	char message[1024] = {0}; 
	char buffer[1024] = {0}; 
	int length;
	char * result;
	int sign[15];
	char sign1[15] = {0};
	char sign2[15] = {0};
	int i = 0;
	int j = 0;
	int check = 0;
	char username[20] = {0}; 
	char district[20] = {0};


	if ((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0) 
	{ 
		printf("\n Socket creation error \n"); 
		return -1; 
	} 

	serv_addr.sin_family = AF_INET; 
	serv_addr.sin_port = htons(PORT); 
	
	// Convert IPv4 and IPv6 addresses from text to binary form 
	if(inet_pton(AF_INET, "127.0.0.1", &serv_addr.sin_addr)<=0) 
	{ 
		printf("\nInvalid address/ Address not supported \n"); 
		return -1; 
	} 

	if (connect(sock, (struct sockaddr *)&serv_addr, sizeof(serv_addr)) < 0) 
	{ 
		printf("\nConnection Failed \n"); 
		return -1; 
	} 

	printf("Agent Username:");
	scanf(" %s", username); 
	getchar();
	send(sock , username , strlen(username) , 0 );
	printf("Agent District:");
	scanf(" %s", district);
	getchar();
	send(sock , district , strlen(district) , 0 );
	printf("\n");

	//Adding provision for a Client user to type a message
	printf("Please Enter A Command\n");
	printf("----------------------------------------------------------------\n");
	printf("1) To submit the new member list: Addmember member_name, date(YYYY-MM-DD), gender, recommender \n");
	printf("2) To check status of the file: Check_status\n");
	printf("3) To check statement of payments for the logged in user: Get_statement\n");
	printf("4) To submit new members from the file: Addmember filename.txt\n");
	printf("5) To search and view a record from file by date or name: Search criteria(Name/Date) \"Person's Name/ Record's Date\"\n");
	printf("6) To add signature and end session: Signature\n");
	printf("7) For Help menu: help\n");
	printf("----------------------------------------------------------------\n");

	do
	{
		fgets(message, 1024, stdin);

		length = strlen(message);
		send(sock , message , strlen(message) , 0 );

		if(result = strstr(message, "Signature")){
			for(i = 0; i < 15; i++){
				printf("Enter 0 or 1 for cell[%d]:", i+1);
				scanf(" %d", &sign[i]);
			}

			
			for(i = 0; i < 15; i++){
				
				if(sign[i] == 0){
					sign1[i] = ' ';
				}
				else if(sign[i] == 1){
					sign1[i] = '*';
				}
				else{
					printf("\nWrong Number Choice Entered!. Press any key to exit.");
				}
			}

			printf("%ld\n", strlen(sign1));
			
			i=0;
			printf("\n");
			printf("\n");
			
			for(j = 0; j < 5; j++){
				check = 0;
				for(i; check < 3; i++){
					printf("%c ",sign1[i]);
					check ++;
				}
				printf("\n");
			}


			send(sock , sign1 , 15 , 0 );
		}
		else if(result = strstr(message, "signature")){
			for(i = 0; i < 15; i++){
			printf("Enter 0 or 1 for cell[%d]:", i+1);
			scanf(" %d", &sign[i]);
			}
			getchar();
			
			for(i = 0; i < 15; i++){
				
				if(sign[i] == 0){
					sign1[i] = ' ';
				}
				else if(sign[i] == 1){
					sign1[i] = '*';
				}
				else{
					printf("\nWrong Number Choice Entered!. Press any key to exit.");
				}
			}
			
			i=0;
			printf("\n");
			printf("\n");
			
			for(j = 0; j < 5; j++){
				check = 0;
				for(i; check < 3; i++){
					printf("%c ",sign1[i]);
					check ++;
				}
				printf("\n");
			}
			send(sock , sign1 , strlen(sign1) , 0 );
		}
		else if(result = strstr(message, "help") || result = strstr(message, "Help")){
			printf("Please Enter A Command\n");
			printf("----------------------------------------------------------------\n");
			printf("1) To submit the new member list: Addmember member_name, date(YYYY-MM-DD), gender, recommender \n");
			printf("2) To check status of the file: Check_status\n");
			printf("3) To check statement of payments for the logged in user: Get_statement\n");
			printf("4) To submit new members from the file: Addmember filename.txt\n");
			printf("5) To search and view a record from file by date or name: Search criteria(Name/Date) \"Person's Name/ Record's Date\"\n");
			printf("6) To add signature and end session: Signature\n");
			printf("7) For Help menu: help\n");
			printf("----------------------------------------------------------------\n");
		}
		else{
			
			printf("Command Sent!\n");
			valread = recv( sock , buffer, 1024, 0); 
			buffer [valread] = '\0';
			printf("%s\n",buffer ); 
		}

		printf("\n");
		
	} while (message != "Exit" || message != "exit");
	
	return 0; 
} 

