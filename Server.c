#include <unistd.h> 
#include <stdio.h> 
#include <sys/socket.h> 
#include <stdlib.h> 
#include <netinet/in.h> 
#include <string.h> 
#define mkstr(s) #s
#define PORT 8080 


int main(int argc, char const *argv[]) 
{ 
	int server_fd, new_socket, valread, valread1; 
	struct sockaddr_in address; 
	int opt = 1; 
	int addrlen = sizeof(address); 
	char buffer[1024] = {0};
	char message[1024]; 
	int length;
	char * result;
	char * result1;
	char * result2;
	char * result3;
	char username[20] = {0}; 
	char district[20] = {0};
	char sign2[15] = {0};
	char  result4[1024] = "";
	char result5[100] = "";
	char * result6 = {0}; 
	char result7[100] = ""; 
	char reading[1024] = "";
	char reading1[1024] = "";
	char * first;
	FILE *fp;

	char * hello = {0};
	char sign1[15] = {0};
	int i = 0;
	int j = 0;
	int check = 0;
	
	// Creating socket file descriptor 
	if ((server_fd = socket(AF_INET, SOCK_STREAM, 0)) == 0) 
	{ 
		perror("socket failed"); 
		exit(EXIT_FAILURE); 
	} 
	
	// Forcefully attaching socket to the port 8080 
	if (setsockopt(server_fd, SOL_SOCKET, SO_REUSEADDR | SO_REUSEPORT, 
												&opt, sizeof(opt))) 
	{ 
		perror("setsockopt"); 
		exit(EXIT_FAILURE); 
	} 
	address.sin_family = AF_INET; 
	address.sin_addr.s_addr = INADDR_ANY; 
	address.sin_port = htons( PORT ); 
	
	// Forcefully attaching socket to the port 8080 
	if (bind(server_fd, (struct sockaddr *)&address, 
								sizeof(address))<0) 
	{ 
		perror("bind failed"); 
		exit(EXIT_FAILURE); 
	} 
	if (listen(server_fd, 3) < 0) 
	{ 
		perror("listen"); 
		exit(EXIT_FAILURE); 
	} 
	if ((new_socket = accept(server_fd, (struct sockaddr *)&address, 
					(socklen_t*)&addrlen))<0) 
	{ 
		perror("accept"); 
		exit(EXIT_FAILURE); 
	} 

	strcpy(district,"");

	valread = recv(new_socket , username, 20, 0);
	printf("%s :Username saved!\n", username);
	strcpy(result7, username);
	valread = recv(new_socket , district, 20, 0);
	printf("%s :District saved!\n", district);

	fp = fopen("District.txt", "w");
	if(!fp){
		printf("Something wrong\n");
	}
	fprintf(fp, "%s\n", district);
	fclose(fp);
	
	result6 = strcat(district, ".txt");

	fp = fopen(result6, "a");
	if(!fp){
		printf("Something wrong\n");
	}
	fclose(fp);

	do
	{
		valread = recv(new_socket , buffer, 1024, 0); 
		buffer [valread] = '\0';
		length = strlen(buffer);

		if (result = strstr(buffer,"Addmember"))
		{

			if(result1 = strstr(buffer,"txt")){
				result2 = strchr(buffer, ' ');
				result2 += 1;
				result3 = strtok(result2, "\n");

				fp = fopen( result3 , "r");
				if (!fp)
				{
					printf("Something wrong\n");
				}
				while(!feof(fp)){
					fgets(reading, 1024, fp);
					printf("%s", reading);
					strcat(reading1,reading);
					strcpy(reading, "");
				}
				fclose(fp);

				fp = fopen(result6, "a");
				if (!fp)
				{
					printf("Something wrong\n");
				}
				fprintf (fp, "%s",reading1);
				fclose(fp);

				printf("Success Addmember Text File\n");
				printf("%s\n",buffer ); 
				hello = "Command Processed";
				send(new_socket , hello , strlen(hello) , 0 );
			}
			else{
				result2 = strchr(buffer, ' ');
				result2 += 1;
				result3 = strtok(result2, ",");

				while (result3!= NULL){
					strcat(result4, result3);
					result3 = strtok (NULL, ",");
				}

				printf("%s\n", result4);

				fp = fopen(result6, "a+");
				fseek(fp, 19, SEEK_SET);
				if (!fp)
				{
					printf("Something wrong\n");
				}
			
			fprintf (fp, "\n%s",result4);
			fclose(fp);
			strcpy(result4, "");
			printf("Success Addmember\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			}
		}
		else if (result = strstr(buffer,"addmember"))
		{
			if(result1 = strstr(buffer,"txt")){
				result2 = strchr(buffer, ' ');
				result2 += 1;
				result3 = strtok(result2, "\n");

				fp = fopen( result3 , "r");
				if (!fp)
				{
					printf("Something wrong\n");
				}
				while(!feof(fp)){
					fgets(reading, 1024, fp);
					printf("%s", reading);
					strcat(reading1,reading);
					strcpy(reading, "");
				}
				fclose(fp);

				fp = fopen(result6, "a");
				if (!fp)
				{
					printf("Something wrong\n");
				}
				fprintf (fp, "%s",reading1);
				fclose(fp);

				printf("Success Addmember Text File\n");
				printf("%s\n",buffer ); 
				hello = "Command Processed";
				send(new_socket , hello , strlen(hello) , 0 ); 
			}
			else{
				result2 = strchr(buffer, ' ');
				result2 += 1;
				result3 = strtok(result2, ",");

				while (result3!= NULL){
					strcat(result4, result3);
					result3 = strtok (NULL, ",");
				}

				printf("%s\n", result4);

				fp = fopen(result6, "a+");
				fseek(fp, 19, SEEK_SET);
				if (!fp)
				{
					printf("Something wrong\n");
				}
			
			fprintf (fp, "\n%s",result4);
			fclose(fp);
			strcpy(result4, "");
			printf("Success Addmember\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 ); 
			}
			
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
		}
		else if (result = strstr(buffer,"Check_status"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s", buffer);
			fclose(fp); 
			printf("Success Check Status\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"check_status"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s", "Check_status");
			fclose(fp); 
			printf("Success Check Status\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"Get_statement"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s-%s", result7, buffer);
			fclose(fp); 
			printf("Success Get Statement\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"get_statement"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s-%s", result7, "Get_statement");
			fclose(fp); 
			printf("Success Get Statement\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"Search"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s", buffer);
			fclose(fp); 
			printf("Success Search\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"search"))
		{
			fp = fopen(result6, "a");
			fprintf(fp, "%s", buffer);
			fclose(fp); 
			printf("Success Search\n");
			hello = "Command Processed";
			send(new_socket , hello , strlen(hello) , 0 );
			printf("%s\n",buffer ); 
		}
		else if (result = strstr(buffer,"Signature"))
		{
			strcpy(sign1, "");
			valread1 = recv(new_socket , sign1, 15, 0); 
			sign1 [valread1] = '\0';

			fp = fopen(result6, "a");// "a" means that we are going to write on this file
			if (!fp)
			{
				printf("Something wrong\n");
			}

			printf("%s\n", sign1);

			if(strcmp(sign1, " * * ***** ** *") == 0){
				printf("Signature %s - A\n", result7);
				fprintf(fp, "Signature %s A\n", result7);
			}
			else if(strcmp(sign1, "** * *** * *** ") == 0){
				printf("Signature %s - B\n", result7);
				fprintf(fp, "Signature %s B\n", result7);
			}
			else if( strcmp(sign1, "****  *  *  ***") == 0){
				printf("Signature %s - C\n", result7);
				fprintf(fp, "Signature %s C\n", result7);
			}
			else if(strcmp(sign1, "** * ** ** *** ") == 0){
				printf("Signature %s - D\n", result7);
				fprintf(fp, "Signature %s D\n", result7);
			}
			else if(strcmp(sign1, "****  ****  ***") == 0){
				printf("Signature %s - E\n", result7);
				fprintf(fp, "Signature %s E\n", result7);
			}
			else if(strcmp(sign1, "****  ****  *  ") == 0){
				printf("Signature %s - F\n", result7);
				fprintf(fp, "Signature %s F\n", result7);
			}
			else if(strcmp(sign1, "****  **** ****") == 0){
				printf("Signature %s - G\n", result7);
				fprintf(fp, "Signature %s G\n", result7);
			}
			else if(strcmp(sign1, "* ** ***** ** *") == 0){
				printf("Signature %s - H\n", result7);
				fprintf(fp, "Signature %s H\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  * ***") == 0){
				printf("Signature %s - I\n", result7);
				fprintf(fp, "Signature %s I\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  * ** ") == 0){
				printf("Signature %s - J\n", result7);
				fprintf(fp, "Signature %s J\n", result7);
			}
			else if(strcmp(sign1, "* *** ** * ** *") == 0){
				printf("Signature %s - K\n", result7);
				fprintf(fp, "Signature %s K\n", result7);
			}
			else if(strcmp(sign1, "*  *  *  *  ***") == 0){
				printf("Signature %s - L\n", result7);
				fprintf(fp, "Signature %s L\n", result7);
			}
			else if(strcmp(sign1, "* ***** ** ** *") == 0){
				printf("Signature %s - M\n", result7);
				fprintf(fp, "Signature %s M\n", result7);
			}
			else if(strcmp(sign1, "**** ** ** ** *") == 0){
				printf("Signature %s - N\n", result7);
				fprintf(fp, "Signature %s N\n", result7);
			}
			else if(strcmp(sign1, "**** ** ** ****") == 0){
				printf("Signature %s - O\n", result7);
				fprintf(fp, "Signature %s O\n", result7);
			}
			else if(strcmp(sign1, "**** *****  *  ") == 0){
				printf("Signature %s - P\n", result7);
				fprintf(fp, "Signature %s P\n", result7);
			}
			else if(strcmp(sign1, "**** ** ****  *") == 0){
				printf("Signature %s - Q\n", result7);
				fprintf(fp, "Signature %s Q\n", result7);
			}
			else if(strcmp(sign1, "**** ****** * *") == 0){
				printf("Signature %s - R\n", result7);
				fprintf(fp, "Signature %s R\n", result7);
			}
			else if(strcmp(sign1, "****  ***  ****") == 0){
				printf("Signature %s - S\n", result7);
				fprintf(fp, "Signature %s S\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  *  * ") == 0){
				printf("Signature %s - T\n", result7);
				fprintf(fp, "Signature %s T\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ** ****") == 0){
				printf("Signature %s - U\n", result7);
				fprintf(fp, "Signature %s U\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ** * * ") == 0){
				printf("Signature %s - V\n", result7);
				fprintf(fp, "Signature %s V\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ***** *") == 0){
				printf("Signature %s - W\n", result7);
				fprintf(fp, "Signature %s W\n", result7);
			}
			else if(strcmp(sign1, "* ** * * * ** *") == 0){
				printf("Signature %s - X\n", result7);
				fprintf(fp, "Signature %s X\n", result7);
			}
			else if(strcmp(sign1, "* ** * *  *  * ") == 0){
				printf("Signature %s - Y\n", result7);
				fprintf(fp, "Signature %s Y\n", result7);
			}
			else if(strcmp(sign1, "***  * * *  ***") == 0){
				printf("Signature %s - Z\n", result7);
				fprintf(fp, "Signature %s Z\n", result7);
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
			printf("%s\n",buffer ); 
			fclose(fp);
			hello = "Signature Added";
			send(new_socket , hello , strlen(hello) , 0 );
		}
		else if (result = strstr(buffer,"signature"))
		{
			strcpy(sign1, "");
			valread1 = recv(new_socket , sign1, 15, 0); 
			sign1 [valread1] = '\0';

			fp = fopen(result6, "a");// "a" means that we are going to write on this file
			if (!fp)
			{
				printf("Something wrong\n");
			}

			printf("%s\n", sign1);

			if(strcmp(sign1, " * * ***** ** *") == 0){
				printf("Signature %s - A\n", result7);
				fprintf(fp, "Signature %s A\n", result7);
			}
			else if(strcmp(sign1, "** * *** * *** ") == 0){
				printf("Signature %s - B\n", result7);
				fprintf(fp, "Signature %s B\n", result7);
			}
			else if( strcmp(sign1, "****  *  *  ***") == 0){
				printf("Signature %s - C\n", result7);
				fprintf(fp, "Signature %s C\n", result7);
			}
			else if(strcmp(sign1, "** * ** ** *** ") == 0){
				printf("Signature %s - D\n", result7);
				fprintf(fp, "Signature %s D\n", result7);
			}
			else if(strcmp(sign1, "****  ****  ***") == 0){
				printf("Signature %s - E\n", result7);
				fprintf(fp, "Signature %s E\n", result7);
			}
			else if(strcmp(sign1, "****  ****  *  ") == 0){
				printf("Signature %s - F\n", result7);
				fprintf(fp, "Signature %s F\n", result7);
			}
			else if(strcmp(sign1, "****  **** ****") == 0){
				printf("Signature %s - G\n", result7);
				fprintf(fp, "Signature %s G\n", result7);
			}
			else if(strcmp(sign1, "* ** ***** ** *") == 0){
				printf("Signature %s - H\n", result7);
				fprintf(fp, "Signature %s H\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  * ***") == 0){
				printf("Signature %s - I\n", result7);
				fprintf(fp, "Signature %s I\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  * ** ") == 0){
				printf("Signature %s - J\n", result7);
				fprintf(fp, "Signature %s J\n", result7);
			}
			else if(strcmp(sign1, "* *** ** * ** *") == 0){
				printf("Signature %s - K\n", result7);
				fprintf(fp, "Signature %s K\n", result7);
			}
			else if(strcmp(sign1, "*  *  *  *  ***") == 0){
				printf("Signature %s - L\n", result7);
				fprintf(fp, "Signature %s L\n", result7);
			}
			else if(strcmp(sign1, "* ***** ** ** *") == 0){
				printf("Signature %s - M\n", result7);
				fprintf(fp, "Signature %s M\n", result7);
			}
			else if(strcmp(sign1, "**** ** ** ** *") == 0){
				printf("Signature %s - N\n", result7);
				fprintf(fp, "Signature %s N\n", result7);
			}
			else if(strcmp(sign1, "**** ** ** ****") == 0){
				printf("Signature %s - O\n", result7);
				fprintf(fp, "Signature %s O\n", result7);
			}
			else if(strcmp(sign1, "**** *****  *  ") == 0){
				printf("Signature %s - P\n", result7);
				fprintf(fp, "Signature %s P\n", result7);
			}
			else if(strcmp(sign1, "**** ** ****  *") == 0){
				printf("Signature %s - Q\n", result7);
				fprintf(fp, "Signature %s Q\n", result7);
			}
			else if(strcmp(sign1, "**** ****** * *") == 0){
				printf("Signature %s - R\n", result7);
				fprintf(fp, "Signature %s R\n", result7);
			}
			else if(strcmp(sign1, "****  ***  ****") == 0){
				printf("Signature %s - S\n", result7);
				fprintf(fp, "Signature %s S\n", result7);
			}
			else if(strcmp(sign1, "*** *  *  *  * ") == 0){
				printf("Signature %s - T\n", result7);
				fprintf(fp, "Signature %s T\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ** ****") == 0){
				printf("Signature %s - U\n", result7);
				fprintf(fp, "Signature %s U\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ** * * ") == 0){
				printf("Signature %s - V\n", result7);
				fprintf(fp, "Signature %s V\n", result7);
			}
			else if(strcmp(sign1, "* ** ** ***** *") == 0){
				printf("Signature %s - W\n", result7);
				fprintf(fp, "Signature %s W\n", result7);
			}
			else if(strcmp(sign1, "* ** * * * ** *") == 0){
				printf("Signature %s - X\n", result7);
				fprintf(fp, "Signature %s X\n", result7);
			}
			else if(strcmp(sign1, "* ** * *  *  * ") == 0){
				printf("Signature %s - Y\n", result7);
				fprintf(fp, "Signature %s Y\n", result7);
			}
			else if(strcmp(sign1, "***  * * *  ***") == 0){
				printf("Signature %s - Z\n", result7);
				fprintf(fp, "Signature %s Z\n", result7);
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
			printf("%s\n",buffer ); 
			fclose(fp);
			hello = "Signature Added";
			send(new_socket , hello , strlen(hello) , 0 );
		}
		else{
			hello = "Wrong Command Entered. Please enter a valid command!!";
			send(new_socket , hello , strlen(hello) , 0 );
		}

	} while (buffer != "Exit" || buffer != "exit");

	 
	return 0; 
} 

