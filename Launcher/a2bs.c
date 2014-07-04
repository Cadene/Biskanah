#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>
#include <string.h>

int main(int argc, char const *argv[])
{
	int i;
	if(argc < 2 ) 
	{
		printf("no script file !!\n");
		return -1;
	}
	
	for(i=1; i<argc; i++)
	{
		printf("file num %d\n",i);
		char* file =(char*)malloc(sizeof(char)*strlen(argv[i]));
		strcpy(file,argv[i]);
		if(fork()==0)
		{
			while(1)
			{
				if(fork()==0)
					execl("/usr/bin/php","php",file,NULL);
				wait(NULL);
				sleep(1);
			}
		}
	}
	for (i = 1; i < argc; ++i)
	{
		wait(NULL);
	}
	return 0;
}